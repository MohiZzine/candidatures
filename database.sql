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
  photo TEXT NOT NULL,
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
  program_title VARCHAR(40) NOT NULL,
  program_description TEXT NOT NULL,
  programme_video TEXT NOT NULL,
  programme_affiche TEXT NOT NULL,
  PRIMARY KEY (program_id),
  FOREIGN KEY (candidate_id) REFERENCES candidates (candidate_id)
);


-- Inserting predefined data
INSERT INTO users (username, name, email, password, is_admin)
VALUES
('Mohi', 'Mohieddine Farid', 'mohieddinefarid@gmail.com', 'mohi2003', 0),
('ABentajer', "Ahmed Bentajer", 'abentajer@gmail.com', 'abentajer', 1);

  ('abdobnd', 'Abderrahmane Baidoune', 'bnd@example.com', '', 0),
  ('arnbasma', 'Basma Arnaoui', 'basma@example.com', '', 0),
  ('iboud','Ilyas Boudhaine', 'iboud@gmail.com', 0),
  ('soufi', 'Soufiane El Amrani', 'soufi@gmail.com', 0),
  ('Salimi', 'Mohamed Amine Salimi', 'salimi@gmail.com', 0),
  ('Ghali', 'El Ghali Benjelloun', 'ghali@gmail.com', 0),
  ('Fadil', 'Fatima Ezzahrae Fadil', 'fadil@gmail.com', 0),
  ('maryam', 'Maryam Mennou', 'maryam@gmail.com', 0),
  ('sami', 'Sami Agourram', 'sami@gmail.com', 0),
  ('maftah', 'Mahmoud Maftah', 'maftah@example.com', '', 0);

INSERT INTO elections(title, description, start_date, end_date)
VALUES 
  ('Élection du président du conseil des étudiants', 'Élection du président de l’Université pour l’année académique 2023-2024', '2023-09-01 00:00:00', '2023-09-07 23:59:59'),
  ('Élection du délégué de classe CPI1 pour l\’année académique 2023/2024', 'Élection du représentant des étudiants pour l’année académique 2023-2024', '2023-09-08 00:00:00', '2023-09-14 23:59:59'),

  
  ('Élection du délégué de classe CPI2 pour l\’année académique 2023/2024', 'Élection du représentant des étudiants pour l’année académique 2023-2024', '2023-09-08 00:00:00', '2023-09-14 23:59:59');

INSERT INTO candidates (election_id, candidate_name, photo)
VALUES 
  (1, 'Aberrahmane Baidoune', 'https://example.com/images/ali_benkirane.jpg'),
  (3, 'Aberrahmane Baidoune', 'https://example.com/images/ali_benkirane.jpg'),
  (1, 'Basma Arnaoui', 'https://example.com/images/fatima_zahra_el_idrissi.jpg'),
  (3, 'Basma Arnaoui', 'https://example.com/images/fatima_zahra_el_idrissi.jpg'),
  (2, 'Fatima Ezzahra Fadil', 'https://example.com/images/said_el_khadiri.jpg'),
  (1, 'Sami Agourram', 'https://example.com/images/amina_bouziane.jpg'),
  (2, 'El Ghali Benjelloun', 'https://example.com/images/abdelhak_el_mansouri.jpg');

INSERT INTO votes (election_id, user_id, vote)
VALUES 
  (1, 1, 1), 
  (1, 2, 2),
  (1, 3, 1),
  (2, 1, 4),
  (2, 2, 3),
  (2, 3, 4);

INSERT INTO programs (candidate_id, program_title, program_description, programme_video, programme_affiche)
VALUES 
  (1, 'Programme de développement universitaire', 'Description du programme de développement universitaire', 'https://example.com/videos/program1.mp4', 'https://example.com/images/program1.jpg'),
  (2, 'Programme d’engagement étudiant', 'Description du programme d’engagement étudiant', 'https://example.com/videos/program2.mp4', 'https://example.com/images/program2.jpg'),
  (3, 'Programme de représentation des étudiants', 'Description du programme de représentation des étudiants', 'https://example.com/videos/program3.mp4', 'https://example.com/images/program3.jpg'),
  (4, 'Programme d’engagement communautaire', 'Description du programme d’engagement communautaire', 'https://example.com/videos/program4.mp4', 'https://example.com/images/program4.jpg');