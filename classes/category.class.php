<?php

class Category {
  private $pdo;
  public $category_id;
  public $category_name;  

  public function __construct($db) {
    $this->pdo = $db;
  }

  public function get_categories() {
    $sql = "SELECT * FROM categories";
    $stmt = $this->pdo->execute($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_category() {
    $sql = "SELECT * FROM categories WHERE category_id=:category_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['category_id' => $this->category_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function add_category() {
    $sql = "INSERT INTO categories SET (category_name) VALUES (:category_name)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['category_name' => $this->category_name]);
    return $this->pdo->lastInsertId();
  }

  public function update_category() {
    $sql = "UPDATE categories SET category_name=:category_name WHERE category_id=:category_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['category_name' => $this->category_name, 'category_id' => $this->category_id]);
  }

  public function delete_category() {
    $sql = "DELETE FROM categories WHERE category_id=:category_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['category_id' => $this->category_id]);
  }
}