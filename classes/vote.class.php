<?php

class Vote {
  private $pdo;
  private $id;
  private $election_id;
  private $user_id;
  private $vote;
  private $timestamp;

  public function __construct($db) {
    $this->pdo = $db;
  }

  public function setAttributes($election_id, $user_id, $vote, $timestamp) {
    $this->election_id = $election_id;
    $this->user_id = $user_id;
    $this->vote = $vote;
    $this->timestamp = $timestamp;
  }

  public function get_id() {
    return $this->id;
  }

  public function get_election_id() {
    return $this->election_id;
  }

  public function get_user_id() {
    return $this->user_id;
  }

  public function get_vote() {
    return $this->vote;
  }

  public function get_timestamp() {
    return $this->timestamp;
  }

  public function set_id($id) {
    $this->id = $id;
  }

  public function set_election_id($election_id) {
    $this->election_id = $election_id;
  }

  public function set_user_id($user_id) {
    $this->user_id = $user_id;
  }

  public function set_vote($vote) {
    $this->vote = $vote;
  }

  public function set_timestamp($timestamp) {
    $this->timestamp = $timestamp;
  }

  public function read_all_votes() {
    $query = "SELECT * FROM votes";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function read_all_votes_by_election_id($election_id) {
    $query = "SELECT * FROM votes WHERE election_id = :election_id";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['election_id' => $election_id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }


  public function read_all_votes_by_user_id($user_id) {
    $query = "SELECT * FROM votes WHERE user_id = :user_id";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function delete_vote_by_user($user_id) {
    $sql = "DELETE FROM votes WHERE user_id = :user_id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['user_id' => $user_id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  } 

  public function delete_vote_by_election($election_id) {
    $sql = "DELETE FROM votes WHERE election_id = :election_id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['election_id' => $election_id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function create_vote($election_id, $user_id, $vote) {
    $sql = "INSERT INTO votes (election_id, user_id, vote) VALUES (:election_id, :user_id, :vote)";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['election_id' => $election_id, 'user_id' => $user_id, 'vote' => $vote]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function read_vote_by_id($id) {
    $sql = "SELECT * FROM vote WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['id' => $id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function read_vote_by_election_id($election_id) {
    $sql = "SELECT * FROM votes WHERE election_id = :election_id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['election_id' => $election_id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function read_vote_by_user_id($user_id) {
    $sql = "SELECT * FROM votes WHERE user_id = :user_id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['user_id' => $user_id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function update_vote($vote_id, $vote) {
    $sql = "UPDATE votes SET vote = :vote WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['vote' => $this->vote, 'id' => $vote_id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function delete_vote($vote_id) {
    $sql = "DELETE FROM votes WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['id' => $vote_id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function delete_vote_by_id($id) {
    $sql = "DELETE FROM votes WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    try {
      $stmt->execute(['id' => $id]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

}