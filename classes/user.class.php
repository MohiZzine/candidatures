<?php
// require_once('database.class.php');
class User
{
  private $user_id;
  private $name;
  private $username;
  private $email;
  private $active;
  private $password;
  private $is_admin;
  private $pdo;
  public function __construct($db)
  {
    $this->pdo = $db;
  }

  public function setAttributes($name, $username, $email, $password, $is_admin)
  {
    $this->name = $name;
    $this->username = $username;
    $this->email = $email;
    $this->$is_admin = $is_admin;
    $this->password = $password;
  }

  public function get_name()
  {
    return $this->name;
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

  public function get_is_admin()
  {
    return $this->is_admin;
  }

  public function get_user_id()
  {
    return $this->user_id;
  }

  public function set_user_id($id)
  {
    $this->user_id = $id;
  }

  public function set_is_admin($status)
  {
    $this->is_admin = $status;
  }

  private function set_name($name)
  {
    $this->name = $name;
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
    $is_admin = $this->is_admin ? 1 : 0;
    $sql = "INSERT INTO users(name, username, email, password, is_admin) VALUES (:name, :username, :email, :password, :is_admin)";
    $stmt = $this->pdo->prepare($sql);
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    if ($stmt->execute(['name' => $this->name, 'username' => $this->username, 'email' => $this->email, 'password' => $hashed_password, 'is_admin' => $is_admin])) {
      return [
        'user_id' => $this->pdo->lastInsertId(),
        'name' => $this->name,
        'username' => $this->username,
        'email' => $this->email,
        'password' => $hashed_password,
        'is_admin' => $is_admin
      ];
    }
    return false;
  }

  public function login($username, $password)
  {
    $sql = "SELECT * FROM Users WHERE username=:username";
    $stmt = $this->pdo->prepare($sql);
    $username = htmlspecialchars(strip_tags($username));
    $password = htmlspecialchars(strip_tags($password));
    $stmt->execute(['username' => $username]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      if (password_verify($password, $result['password'])) {
        ['user_id' => $user_id, 'name' => $name, 'username' => $username, 'email' => $email, 'password' => $password, 'is_admin' => $is_admin] = $result;
        $this->setAttributes($name, $username, $email, $password, $is_admin);
        return $result;
      }
      return 'Password is incorrect!';
    }
    return false;
  }


  public function get_user()
  {
    $sql = "SELECT * FROM Users WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $this->user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
  }

  public function reset_password($new_password)
  {
    $sql = "UPDATE users SET password=:password WHERE user_id=:user_id";
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
    $sql = "UPDATE users SET username=:username WHERE user_id=:user_id";
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
    $sql = "UPDATE users SET email=:email WHERE user_id=:user_id";
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
    header('Location: ../login.php');
  }
}
