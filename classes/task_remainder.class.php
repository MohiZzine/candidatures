<?php 

class Task_Remainder {
  private $task_id;
  private $remainder_date_time;
  private $remainder_triggered;
  private $pdo;
  
  public function __construct($db) {
    $this->pdo = $db;
  }

  public function add_task_remainder() {
    $sql = "INSERT INTO Task_Remainder
    SET (task_id, remainder_date_time, remainder_triggered, user_id)
    VALUES (:task_id, :remainder_date_time, :remainder_triggered, :user_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['task_id' => $this->task_id, 'remainder_date_time' => $this->remainder_date_time, 'remainder_triggered' => $this->remainder_triggered]);
    return $this->pdo->lastInsertId();
  }

  public function get_task_remainder() {
    $sql = "SELECT * FROM Task_Remainder WHERE task_id=:task_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['task_id' => $this->task_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function get_task_remainders() {
    $sql = "SELECT * FROM Task_Remainder WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $this->user_id]); // in order to access the user_id, we would need to do some joins with the Task and User tables
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function delete_task_remainder() {
    $sql = "DELETE FROM Task_Reaminder WHERE task_id=:task_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['task_id' => $this->task_id]);
  }

  public function update_task_remainder() {
    $sql = "UPDATE Task_Remainder
    SET task_id=:task_id, remainder_date_time=:remainder_date_time, remainder_triggered=:remainder_triggered
    WHERE task_id=:task_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['task_id' => $this->task_id, 'remainder_date_time' => $this->remainder_date_time, 'remainder_triggered' => $this->remainder_triggered]);
  }
}