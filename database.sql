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
  programme_video VARCHAR(255) NOT NULL,
  programme_affiche INT NOT NULL,
  PRIMARY KEY (program_id),
  FOREIGN KEY (candidate_id) REFERENCES candidates (candidate_id)
);

-- Insert some raw data

INSERT INTO users (username, name, email, password, is_admin)
VALUES
('user1', 'User One', 'user1@email.com', 'password1', 0),

INSERT INTO elections (title, description, start_date, end_date)
VALUES
('Election 1', 'This is the first election.', '2023-06-01 10:10:10', '2023-06-30 23:20:55'),
('Election 2', 'This is the second election.', '2023-06-30 18:30:53', '2023-07-01 30:30:30'),
('Election 3', 'This is the third election.', '2023-06-30 11:59:59', '2023-08-01 50:50:50'),

INSERT INTO candidates (election_id, candidate_name, photo)
VALUES
(1, 'Candidate 1', 'candidate1_photo_url'),

INSERT INTO votes (election_id, user_id, vote)
VALUES
(1, 1, 1, '2023-06-05 10:30:00'),

INSERT INTO programs (candidate_id, program_title, program_description, programme_video, programme_affiche)
VALUES
(1, 'Program 1', 'This is the first program.', 'program1_video_url', 'program1_affiche_url'),
