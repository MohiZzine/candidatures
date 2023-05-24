<?php

class program {
  private $pdo;
  private $program_id;
  private $candidate_id;
  private $title;
  private $description;
  private $video;
  private $affiche;

  public function __construct($db) {
    $this->pdo = $db;
  }

  public function setAttributes($program_id, $candidate_id, $title, $description, $video, $affiche) {
    $this->program_id = $program_id;
    $this->candidate_id = $candidate_id;
    $this->title = $title;
    $this->description = $description;
    $this->video = $video;
    $this->affiche = $affiche;
  }

  public function get_program_id() {
    return $this->program_id;
  }

  public function set_program_id($id) {
    $this->program_id = $id;
  }

  public function get_candidate_id() {
    return $this->candidate_id;
  }

  public function set_candidate_id($id) {
    $this->candidate_id = $id;
  }

  public function get_title() {
    return $this->title;
  }

  public function set_title($title) {
    $this->title = $title;
  }

  public function get_description() {
    return $this->description;
  }

  public function set_description($description) {
    $this->description = $description;
  }

  public function get_video() {
    return $this->video;
  }

  public function set_video($video) {
    $this->video = $video;
  }

  public function get_affiche() {
    return $this->affiche;
  }

  public function set_affiche($affiche) {
    $this->affiche = $affiche;
  }

  public function get_programs() {
    $sql = "SELECT * FROM programs";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $programs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $programs;
  }

  public function get_program($id) {
    $sql = "SELECT * FROM programs WHERE id=:id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $program = $stmt->fetch(PDO::FETCH_ASSOC);
    return $program;
  }

  public function create() {
    $sql = "INSERT INTO programs (candidate_id, title, description, video, affiche) VALUES (:candidate_id, :title, :description, :video, :affiche)";
    $stmt = $this->pdo->prepare($sql);
    $this->candidate_id = htmlspecialchars(strip_tags(trim($this->candidate_id)));
    $this->title = htmlspecialchars(strip_tags(trim($this->title)));
    $this->description = htmlspecialchars(strip_tags(trim($this->description)));
    $this->video = htmlspecialchars(strip_tags(trim($this->video)));
    $this->affiche = htmlspecialchars(strip_tags(trim($this->affiche)));
    if ($stmt->execute(['candidate_id' => $this->candidate_id, 'title' => $this->title, 'description' => $this->description, 'video' => $this->video, 'affiche' => $this->affiche])) {
      return [
        'program_id' => $this->pdo->lastInsertId(),
        'candidate_id' => $this->candidate_id,
        'title' => $this->title,
        'description' => $this->description,
        'video' => $this->video,
        'affiche' => $this->affiche
      ];
    } else {
      return false;
    }
  }

  public function update($id) {
    $sql = "UPDATE programs SET title=:title, description=:description, video=:video, affiche=:affiche WHERE id=:id";
    $stmt = $this->pdo->prepare($sql);
    $this->title = htmlspecialchars(strip_tags(trim($this->title)));
    $this->description = htmlspecialchars(strip_tags(trim($this->description)));
    $this->video = htmlspecialchars(strip_tags(trim($this->video)));
    $this->affiche = htmlspecialchars(strip_tags(trim($this->affiche)));
    if ($stmt->execute(['title' => $this->title, 'description' => $this->description, 'video' => $this->video, 'affiche' => $this->affiche, 'id' => $id])) {
      return [
        'program_id' => $id,
        'title' => $this->title,
        'description' => $this->description,
        'video' => $this->video,
        'affiche' => $this->affiche
      ];
    } else {
      return false;
    }
  }

  public function delete($id) {
    $sql = "DELETE FROM programs WHERE id=:id";
    $stmt = $this->pdo->prepare($sql);
    if ($stmt->execute(['id' => $id])) {
      return true;
    } else {
      return false;
    }
  }

  public function get_programs_by_candidate_id($candidate_id) {
    $sql = "SELECT * FROM programs WHERE candidate_id=:candidate_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['candidate_id' => $candidate_id]);
    $programs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $programs;
  }

  public function get_program_by_candidate_id($candidate_id, $id) {
    $sql = "SELECT * FROM programs WHERE candidate_id=:candidate_id AND id=:id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['candidate_id' => $candidate_id, 'id' => $id]);
    $program = $stmt->fetch(PDO::FETCH_ASSOC);
    return $program;
  }

  

}