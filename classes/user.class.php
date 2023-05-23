<?php
// require_once('database.class.php');
require_once('../server/assets/token_generator.php');
require_once('mailer.php');
class User
{
  private $user_id;
  private $first_name;
  private $username;
  private $email;
  private $active;
  private $password;
  private $is_admin;
  private $activation_expiry;
  private $activation_code;
  private $pdo;
  public function __construct($db)
  {
    $this->pdo = $db;
  }

  public function setAttributes($first_name, $username, $email, $password, $active = false)
  {
    $this->first_name = $first_name;
    $this->username = $username;
    $this->email = $email;
    $this->$active = $active;
    $this->password = $password;
  }

  public function get_first_name()
  {
    return $this->first_name;
  }

  public function get_username()
  {
    return $this->username;
  }

  public function get_email()
  {
    return $this->email;
  }

  public function get_password()
  {
    return $this->password;
  }

  public function get_active()
  {
    return $this->active;
  }

  public function get_is_admin()
  {
    return $this->is_admin;
  }

  public function get_activation_expiry()
  {
    $sql = "SELECT activation_expiry FROM User WHERE user_id = :user_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $this->user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    // return $this->activation_expiry;
  }

  public function get_activation_code()
  {
    return $this->activation_code;
  }

  public function get_user_id()
  {
    return $this->user_id;
  }

  public function set_user_id($id)
  {
    $this->user_id = $id;
  }

  private function set_first_name($first_name)
  {
    $this->first_name = $first_name;
  }

  private function set_username($username)
  {
    $this->username = $username;
  }

  private function set_email($email)
  {
    $this->email = $email;
  }

  private function set_password($password)
  {
    $this->password = $password;
  }

  private function set_active($active)
  {
    $this->active = $active;
  }

  public function register()
  {
    $sql = "INSERT INTO User (first_name, username, email, password, is_admin, active) VALUES (:first_name, :username, :email, :password, 0, 0)";
    $stmt = $this->pdo->prepare($sql);
    $this->first_name = htmlspecialchars(strip_tags($this->first_name));
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    if ($stmt->execute(['first_name' => $this->first_name, 'username' => $this->username, 'email' => $this->email, 'password' => $hashed_password])) {
      return [
        'user_id' => $this->pdo->lastInsertId(),
        'first_name' => $this->first_name,
        'username' => $this->username,
        'email' => $this->email,
        'password' => $hashed_password
      ];
    }
    return false;
  }

  public function login($username_or_email, $password)
  {
    $sql = "SELECT * FROM User WHERE (username=:username) OR (email=:email)";
    $stmt = $this->pdo->prepare($sql);
    $username_or_email = htmlspecialchars(strip_tags($username_or_email));
    $password = htmlspecialchars(strip_tags($password));
    $stmt->execute(['username' => $username_or_email, 'email' => $username_or_email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      if (password_verify($password, $result['password'])) {
        ['user_id' => $user_id, 'first_name' => $first_name, 'username' => $username, 'email' => $email, 'password' => $password] = $result;
        $this->setAttributes($first_name, $username, $email, $password);
        return $result;
      }
      return 'Password is incorrect!';
    }
    return false;
  }

  public function authenticate_user()
  {
    $sql = "UPDATE User SET active = 1 WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $this->user_id]);
  }

  public function send_authentication_code($url)
  {
    $sql = "UPDATE User SET activation_code=:activation_code, activation_expiry=:activation_expiry WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $random_number = strval(token_generator());
    $token = password_hash($random_number, PASSWORD_DEFAULT);
    $this->activation_code = $token;
    $expiry = time() + 1 * 10 * 60;
    $this->activation_expiry = date('Y-m-d H:i:s', $expiry);
    $stmt->execute(['activation_code' => $this->activation_code, 'activation_expiry' => $this->activation_expiry, 'user_id' => $this->user_id]);
    sendMail($this->email, $this->first_name, $token, $url);
    return $token;
  }

  public function verify_authentication_code($code)
  {
    $sql = "SELECT * FROM User WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $this->user_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($code, $result['activation_code'])) {
      $this->authenticate_user();
      return true;
    }
    return false;
  }


  public function get_user()
  {
    $sql = "SELECT * FROM User WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $this->user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  public function reset_password($new_password)
  {
    $sql = "UPDATE user SET password=:password WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $new_password = htmlspecialchars(strip_tags($new_password));
    try {
      $stmt->execute(['password' => $new_password, 'user_id' => $this->user_id]);
      $this->set_password($new_password);
      return ['reset' => true, 'message' => 'Password changed successfully!'];
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        return ['reset' => false, 'message' => 'Password already exists!'];
      } else {
        return ['reset' => false, 'message' => 'An Error has occurred, try again later!'];
      }
    }
  }

  public function change_username($new_username)
  {
    $sql = "UPDATE user SET username=:username WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $new_username = htmlspecialchars(strip_tags($new_username));
    try {
      $stmt->execute(['username' => $new_username, 'user_id' => $this->user_id]);
      $this->set_username($new_username);
      return ['reset' => true, 'message' => 'Username changed successfully!'];
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        return ['reset' => false, 'message' => 'Username already exists!'];
      } else {
        return ['reset' => false, 'message' => 'An Error has occurred, try again later!'];
      }
    }
  }


  public function change_email($new_email)
  {
    $sql = "UPDATE user SET email=:email WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $new_email = htmlspecialchars(strip_tags($new_email));
    try {
      $stmt->execute(['email' => $new_email, 'user_id' => $this->user_id]);
      $this->set_email($new_email);
      $this->set_active(false);
      return ['reset' => true, 'message' => 'Email changed successfully!'];
    } catch (PDOException $e) {
      if ($e->getCode() == 23000) {
        return ['reset' => false, 'message' => 'Email already exists!'];
      } else {
        return ['reset' => false, 'message' => 'An Error has occurred, try again later!'];
      }
    }
  }

  public function logout()
  {
    session_destroy();
    header('Location: login.php');
  }
}
