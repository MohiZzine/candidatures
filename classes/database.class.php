<?php

require_once('../initialize.php');

class Database {
  private $host = DB_SERVER;
  private $db = DB_NAME;
  private $username = DB_USERNAME;
  private $password = DB_PASSWORD;
  public $pdo;

  public function getConnection() {
    $this->pdo = null;
    try {
      $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    } catch (PDOException $exception) {
      echo "Connection error:" . $exception->getMessage();
    }
  }
}
