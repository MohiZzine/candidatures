<?php

class Task_Category {
  private $category_id;
  private $task_id;
  private $pdo;

  public function __construct($db) {
    $this->pdo = $db;
  }

  public function add_task_category() {
    $sql = "INSERT INTO Task_Category
    SET (category_id, task_id)
    VALUES (:category_id, :task_id)
    ";
    $stmt = $this->pdo->preapre($sql);
    $stmt->execute(['category_id' => $this->category_id, 'task_id' => $this->task_id]);
    return $this->pdo->lastInsertId();
  }

  public function get_task_category() {
    $sql = "SELECT * FROM Task_Category WHERE task_id=:task_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['task_id' => $this->task_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function get_task_categories() {
    $sql = "SELECT * FROM Task_Category WHERE category_id=:category_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['category_id' => $this->category_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  
  public function update_task_category() {
    $sql = "UPDATE Task_Category
    SET category_id=:category_id, task_id=:task_id
    WHERE task_id=:task_id AND category_id=:category_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['category_id' => $this->category_id, 'task_id' => $this->task_id]);
  }
  
  public function delete_task_category() {
    $sql = "DELETE FROM Task_Category
    WHERE task_id=:task_id AND category_id=:category_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['task_id' => $this->task_id, 'category_id' => $this->category_id]);
  }

  public function get_category_id() {
    return $this->category_id;
  }

  public function set_category_id($category_id) {
    $this->category_id = $category_id;
  }

  public function get_task_id() {
    return $this->task_id;
  }

  public function set_task_id($task_id) {
    $this->task_id = $task_id;
  }
}