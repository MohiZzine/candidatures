<?php 
class Election {
  private $id;
  private $title;
  private $description;
  private $start_date;
  private $end_date;
  private $pdo;

  public function __construct($db) {
    $this->pdo = $db;
  }

  public function setAttributes($title, $description, $start_date, $end_date) {
    $this->title = $title;
    $this->description = $description;
    $this->start_date = $start_date;
    $this->end_date = $end_date;
  }

  public function get_id() {
    return $this->id;
  }

  public function get_title() {
    return $this->title;
  }

  public function get_description() {
    return $this->description;
  }

  public function get_start_date() {
    return $this->start_date;
  }

  public function get_end_date() {
    return $this->end_date;
  }

  public function set_id($id) {
    $this->id = $id;
  }

  public function set_title($title) {
    $this->modify_election_title($this->id, $title);
    $this->title = $title;
  }

  public function set_description($description) {
    $this->description = $description;
  }

  public function set_start_date($start_date) {
    $this->start_date = $start_date;
  }

  public function set_end_date($end_date) {
    $this->end_date = $end_date;
  }

  public function create() {
    $sql = "INSERT INTO elections (title, description, start_date, end_date) VALUES (:title, :description, :start_date, end_date)";
    $stmt = $this->pdo->prepare($sql);
    $this->title = htmlspecialchars(strip_tags(trim($this->title)));
    $this->description = htmlspecialchars(strip_tags(trim($this->description)));
    $this->start_date = htmlspecialchars(strip_tags(trim($this->start_date)));
    $this->end_date = htmlspecialchars(strip_tags(trim($this->end_date)));
    if ($stmt->execute(['title' => $this->title, 'description' => $this->description, 'start_date' => $this->start_date, 'end_date' => $this->end_date])) {
      return [
        'election_id' => $this->pdo->lastInsertId(),
        'title' => $this->title,
        'description' => $this->description,
        'start_date' => $this->start_date,
        'end_date' => $this->end_date
      ];
    } else {
      return false;
    }
  }

  public function read_all_elections() {
    $sql = "SELECT * FROM elections";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $elections = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $elections;
  }

  public function read_election_by_id($id) {
    $sql = "SELECT * FROM elections WHERE id=:id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['id' => $id]);
      $election = $stmt->fetch(PDO::FETCH_ASSOC);
      return $election;
    } catch (PDOException $exception) {
      echo "Error: " . $exception->getMessage();
    }
  }

  public function delete_election($id) {
    $sql = "DELETE FROM elections WHERE id=:id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function modify_election_description($id, $description) {
    $sql = "UPDATE elections SET description=:description WHERE id=:id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['description' => $description, 'id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function modify_election_title($id, $title) {
    $sql = "UPDATE elections SET title=:title WHERE id=:id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['title' => $title, 'id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function modify_election_start_date($id, $start_date) {
    $sql = "UPDATE elections SET start_date=:start_date WHERE id=:id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['start_date' => $start_date, 'id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function modify_election_end_date($id, $end_date) {
    $sql = "UPDATE elections SET end_date=:end_date WHERE id=:id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['end_date' => $end_date, 'id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function modify_election_status($id, $status) {
    $sql = "UPDATE elections SET status=:status WHERE id=:id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['status' => $status, 'id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}