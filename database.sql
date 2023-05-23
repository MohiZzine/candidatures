CREATE DATABASE IF NOT EXISTS candidatures;
use candidatures;

CREATE TABLE IF NOT EXISTS users (
  user_id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(45) NOT NULL,
  name VARCHAR(45) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(255) NOT NULL,
  is_admin BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS elections (
  election_id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(45) NOT NULL,
  description VARCHAR(255) NOT NULL,
  start_date DATETIME NOT NULL,
  end_date DATETIME NOT NULL,
  PRIMARY KEY (election_id)
);


CREATE TABLE IF NOT EXISTS candidates (
  candidate_id INT NOT NULL AUTO_INCREMENT,
  election_id INT NOT NULL,
  candidate_name VARCHAR(45) NOT NULL,
  photo VARCHAR(255) NOT NULL,
  PRIMARY KEY (candidate_id),
  FOREIGN KEY (election_id) REFERENCES elections (election_id)
);

CREATE TABLE IF NOT EXISTS votes (
  vote_id INT NOT NULL AUTO_INCREMENT,
  election_id INT NOT NULL,
  user_id INT NOT NULL,
  vote INT NOT NULL,
  timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (vote_id),
  FOREIGN KEY (vote) REFERENCES candidates (candidate_id),
  FOREIGN KEY (election_id) REFERENCES elections (election_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id)
);

CREATE TABLE IF NOT EXISTS programs (
  program_id INT NOT NULL AUTO_INCREMENT,
  candidate_id INT NOT NULL,
  program_title INT NOT NULL,
  program_description INT NOT NULL,
  programme_video INT NOT NULL,
  programme_affiche INT NOT NULL,
  PRIMARY KEY (program_id),
  FOREIGN KEY (candidate_id) REFERENCES candidates (candidate_id),
);