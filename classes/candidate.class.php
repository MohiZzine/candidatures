<?php

class Candidate {
  private $pdo;
  private $id;
  private $election_id;
  private $name;
  private $photo;

  public function __construct($db) {
    $this->pdo = $db;
  }

  public function setAttributes($election_id, $name, $photo) {
    $this->election_id = $election_id;
    $this->name = $name;
    $this->photo = $photo;
  }

  public function get_id() {
    return $this->id;
  }

  public function get_election_id() {
    return $this->election_id;
  }

  public function get_name() {
    return $this->name;
  }

  public function get_photo() {
    return $this->photo;
  }

  public function set_id($id) {
    $this->id = $id;
  }

  public function set_election_id($election_id) {
    $this->election_id = $election_id;
  }

  public function set_name($name) {
    $this->name = $name;
  }

  public function set_photo($photo) {
    $this->photo = $photo;
  }

  public function get_candidates_by_election($election_id) {
    $sql = "SELECT * FROM candidates WHERE election_id = :election_id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['election_id' => $election_id]);
      $candidates = $stmt->fetchAll();
      return $candidates;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function get_candidate($id) {
    $sql = "SELECT * FROM candidates WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['id' => $id]);
      $candidate = $stmt->fetch();
      return $candidate;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function add_candidate($election_id, $name, $photo) {
    $sql = "INSERT INTO candidates (election_id, name, photo) VALUES (:election_id, :name, :photo)";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['election_id' => $election_id, 'name' => $name, 'photo' => $photo]);
      return true;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function update_candidate($id, $name, $photo) {
    $sql = "UPDATE candidates SET name = :name, photo = :photo WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['name' => $name, 'photo' => $photo, 'id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function update_candidate_name($id, $name) {
    $sql =  "UPDATE candidates SET name = :name WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['name' => $name, 'id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo "Error : " . $e->getMessage();
    }
  }

  public function update_candidate_photo($id, $photo) {
    $sql = "UPDATE candidate SET photo = :photo WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['photo' => $photo, 'id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo "Error : " . $e->getMessage();
    }
  }

  public function delete_candidate($id) {
    $sql = "DELETE FROM candidate WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo "Error : " . $e->getMessage();
    }
  }

  public function delete_candidates_by_election($election_id) {
    $sql = "DELETE FROM candidates WHERE election_id = :election_id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['election_id' => $election_id]);
      return true;
    } catch (PDOException $e) {
      echo "Error : " . $e->getMessage();
    }
  }
}