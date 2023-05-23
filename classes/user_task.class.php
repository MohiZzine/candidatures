<?php

require_once('database.class.php');
require_once('user.class.php');
require_once('task.class.php');
class User_Task {
  private $user_id;
  private $task_id;
  private $pdo;

  public function __construct($db) {
    $this->pdo = $db;
  }

  public function add_user_task() {
    $sql = "INSERT INTO user_tasks SET (user_id, task_id) VALUES (:user_id, :task_id)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $this->user_id, 'task_id' => $this->task_id]);
  }

  public function get_user_tasks() {
    $sql = "SELECT * FROM user_tasks WHERE user_id=:user_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $this->user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_user_task() {
    $sql = "SELECT * FROM user_tasks WHERE user_id=:user_id AND task_id=:task_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $this->user_id, 'task_id' => $this->task_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function delete_user_task() {
    $sql = "DELETE FROM user_tasks WHERE user_id=:user_id AND task_id=:task_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $this->user_id, 'task_id' => $this->task_id]);
  }
}