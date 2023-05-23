<?php
session_start();
require_once 'database.class.php';
class Task {
  public $task_id;
  public $task_name;
  public $task_description;
  public $status;
  public $due_date;
  private $pdo;

  public function __construct($db) {
    $this->pdo = $db;
  }

  public function add_task() {
    $sql = "INSERT INTO tasks SET (task_name, task_description, status, due_date) VALUES (:task_name, :task_description, :status, :due_date)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['task_name' => $this->task_name, 'task_description' => $this->task_description, 'status' => $this->status, 'due_date' => $this->due_date]);
    return $this->pdo->lastInsertId();
  }

  public function get_tasks() {
    $sql = "SELECT * FROM Task WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_task() {
    $sql = "SELECT * FROM Task WHERE task_id=:task_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['task_id' => $this->task_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update_task() {
    $sql = "UPDATE Task 
    SET tak_name=:task_name, task_description=:task_description, status=:status, due_date=:due_date
    WHERE task_id=:task_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['task_name' => $this->task_name, 'task_description' => $this->task_description, 'status' => $this->status, 'due_date' => $this->due_date, 'task_id' => $this->task_id]);
  }

  public function delete_task() {
    $sql = "DELETE FROM Task WHERE task_id=:task_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['task_id' => $this->task_id]);
  }
}