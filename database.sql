CREATE DATABASE IF NOT EXISTS candidatures;
use candidatures;

CREATE TABLE IF NOT EXISTS users (
  user_id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(45) NOT NULL UNIQUE,
  name VARCHAR(45) NOT NULL UNIQUE,
  email VARCHAR(60) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL UNIQUE,
  is_admin BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS elections (
  election_id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(200) NOT NULL UNIQUE,
  description VARCHAR(255) NOT NULL UNIQUE,
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
  vote INT NOT NULL UNIQUE,
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
  PRIMARY KEY (program_id),
  FOREIGN KEY (candidate_id) REFERENCES candidates (candidate_id)
);

INSERT INTO elections(title, description, start_date, end_date)
VALUES 
  ('Président du conseil des étudiants', 'Élection du président de l’Université pour l’année académique 2023-2024', '2023-09-01 00:00:00', '2023-09-07 23:59:59'),
  ('Délégué de classe CPI1', 'Représentant des étudiants', '2023-09-08 00:00:00', '2023-09-14 23:59:59'),

  
  ('Délégué de classe CPI2', 'Élection du représentant des étudiants pour l’année académique 2023-2024', '2023-09-08 00:00:00', '2023-09-14 23:59:59');

INSERT INTO candidates (election_id, candidate_name, photo) VALUES
(2, 'Fatima Zahrae Fadil', 'https://img.freepik.com/photos-gratuite/jolie-fille-blonde-chemise-rayee-montrant-signe-paix-vue-face-dame-francaise-riant-posant-mur-bleu_197531-14466.jpg'),
(3, 'Baidoune Abderrahmane', 'https://img.freepik.com/photos-gratuite/homme-affaires-prospere-garde-mains-croisees-expression-satisfaite_273609-16711.jpg'),
(3, 'Basma Arnaoui', 'https://media.istockphoto.com/id/536932782/fr/photo/magnifique-sourire-magnifique-brunette-portrait.jpg?s=612x612&w=0&k=20&c=eQ-n3an089RhuH-RYWMZHoUa2tWWXaJdhKBMLiQNoR8='),
(2, 'El Ghali Benjelloun', 'https://thumbs.dreamstime.com/b/photo-d-optimisme-exprimant-la-personne-joyeuse-faisant-main-de-participation-v-signe-sur-le-fond-gris-isolement-par-taille-154888614.jpg'),
(1, 'Baidoune Abderrahmane', 'https://img.freepik.com/photos-gratuite/homme-affaires-prospere-garde-mains-croisees-expression-satisfaite_273609-16711.jpg'),
(1, 'Sami Agourram', 'https://images.pexels.com/photos/1681010/pexels-photo-1681010.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500');


-- INSERT INTO votes (election_id, user_id, vote, timestamp)
-- VALUES 
--   (1, 1, 1, '2023-09-02 10:00:00'), 
--   (1, 2, 2, '2023-09-02 10:30:00'),
--   (1, 3, 1, '2023-09-02 11:00:00'),
--   (2, 1, 4, '2023-09-09 09:45:00'),
--   (2, 2, 3, '2023-09-09 10:15:00'),
--   (2, 3, 4, '2023-09-09 10:45:00');


-- INSERT INTO programs (candidate_id, program_title, program_description, programme_video, programme_affiche)
-- VALUES 
--   (1, 'Programme de développement universitaire', 'Description du programme de développement universitaire', 'https://example.com/videos/program1.mp4', 'https://example.com/images/program1.jpg'),
--   (2, 'Programme d’engagement étudiant', 'Description du programme d’engagement étudiant', 'https://example.com/videos/program2.mp4', 'https://example.com/images/program2.jpg'),
--   (3, 'Programme de représentation des étudiants', 'Description du programme de représentation des étudiants', 'https://example.com/videos/program3.mp4', 'https://example.com/images/program3.jpg'),
--   (4, 'Programme d’engagement communautaire', 'Description du programme d’engagement communautaire', 'https://example.com/videos/program4.mp4', 'https://example.com/images/program4.jpg');