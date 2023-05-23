CREATE DATABASE IF NOT EXISTS todo;
USE todo;

  -- password: hashed and salted
CREATE TABLE IF NOT EXISTS User (
  user_id INT AUTO_INCREMENT,
  first_name VARCHAR(40) NOT NULL,
  username VARCHAR(25) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL UNIQUE,
  is_admin tinyint(1) NOT NULL DEFAULT 0,
  active tinyint(1) NOT NULL DEFAULT 0,
  activation_code VARCHAR(255),
  activation_expiry datetime,
  PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS Task(
  task_id INT AUTO_INCREMENT,
  task_name VARCHAR(255) NOT NULL,
  task_description VARCHAR(255) NULL,
  due_date DATE NULL,
  status ENUM('not started', 'in progress', 'paused', 'completed') NOT NULL,
  PRIMARY KEY (task_id)
);

CREATE TABLE IF NOT EXISTS Category(
  category_id INT AUTO_INCREMENT,
  category_name VARCHAR(255) NOT NULL,
  PRIMARY KEY (category_id)
);

CREATE TABLE IF NOT EXISTS Task_Category(
  task_id INT NOT NULL,
  category_id INT,
  PRIMARY KEY (task_id, category_id),
  FOREIGN KEY (task_id) REFERENCES Task(task_id),
  FOREIGN KEY (category_id) REFERENCES Category(category_id)
);

CREATE TABLE IF NOT EXISTS User_Task(
  user_id INT,
  task_id INT,
  PRIMARY KEY (user_id, task_id),
  FOREIGN KEY (user_id) REFERENCES User(user_id),
  FOREIGN KEY (task_id) REFERENCES Task(task_id)
);

CREATE TABLE IF NOT EXISTS Task_Reminder(
  task_id INT, 
  reminder_date_time DATETIME NOT NULL,
  reminder_triggered BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (task_id)
);

-- ADD SOME ROWS IN THE USERS TABLE
INSERT INTO User
(first_name, username, email, password)
VALUES
  ('Mohammed Salah', 'Salah', 'mosalah@gmail.com', 'MoSalah24'),
  ('Leonel Messi', 'Goat', 'leomessi@gmail.com', 'LeoMessi2003'),
  ('Mohieddine Farid', 'MohiZwin', 'mohizzine@gmail.com', 'MohiZzine23');



