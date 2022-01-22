CREATE DATABASE taskforce DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE categories (
	id INT AUTO_INCREMENT,
	name char(128) NOT NULL,
	PRIMARY KEY (id),
	INDEX (name)
);

CREATE TABLE towns (
	id INT AUTO_INCREMENT,
	name char(128) NOT NULL,
	PRIMARY KEY (id),
	INDEX (name)
);

CREATE TABLE roles (
	id INT AUTO_INCREMENT,
	name char(128) NOT NULL,
	PRIMARY KEY (id),
	INDEX (name)
);

CREATE TABLE users (
	id INT AUTO_INCREMENT,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  username char(128) NOT NULL,
	email char(128) NOT NULL,
	pass char(64) NOT NULL,
	avatar_path char(255),
	phone char(11),
  telegram char(64),
  role_id int NOT NULL,
  town_id int NOT NULL,
	PRIMARY KEY (id),
	UNIQUE INDEX (email),
	INDEX (dt_add),
	INDEX (username),
  INDEX (avatar_path),
  INDEX (phone),
  INDEX (telegram),
  INDEX (town_id),
  FOREIGN KEY (town_id) REFERENCES towns (id),
  FOREIGN KEY (role_id) REFERENCES roles (id)
);

CREATE TABLE task (
	id INT AUTO_INCREMENT,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  applicant_id int NOT NULL,
  employer_id int NOT NULL,
  dt_cancel datetime,
	status char(128) NOT NULL,
  name char(128) NOT NULL,
  description char(255) NOT NULL,
  category_id int,
  town_id int,
  location char(255) NOT NULL,
  budget int,
	PRIMARY KEY (id),
	INDEX (name),
	INDEX (dt_add),
  FOREIGN KEY (applicant_id) REFERENCES users (id),
  FOREIGN KEY (employer_id) REFERENCES users (id),
  FOREIGN KEY (town_id) REFERENCES towns (id),
  FOREIGN KEY (category_id) REFERENCES categories (id)
);

CREATE TABLE usersbycategories (
	id INT AUTO_INCREMENT,
  user_id int NOT NULL,
  category_id int NOT NULL,
	PRIMARY KEY (id),
	INDEX (user_id),
  INDEX (category_id),
  FOREIGN KEY (user_id) REFERENCES users (id),
  FOREIGN KEY (category_id) REFERENCES categories (id)
);

CREATE TABLE reviews (
	id INT AUTO_INCREMENT,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  applicant_id int NOT NULL,
  employer_id int NOT NULL,
  task_id int NOT NULL,
  review_text char(255) NOT NULL,
  rating int NOT NULL,
	PRIMARY KEY (id),
	INDEX (dt_add),
	INDEX (applicant_id),
  INDEX (employer_id),
  INDEX (task_id),
  INDEX (review_text),
  FOREIGN KEY (task_id) REFERENCES task (id),
  FOREIGN KEY (applicant_id) REFERENCES users (id),
  FOREIGN KEY (employer_id) REFERENCES users (id)
);

CREATE TABLE responce (
	id INT AUTO_INCREMENT,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  applicant_id int NOT NULL,
  employer_id int NOT NULL,
  task_id int NOT NULL,
  review_text char(255) NOT NULL,
  rating int NOT NULL,
	PRIMARY KEY (id),
	INDEX (dt_add),
	INDEX (applicant_id),
  INDEX (employer_id),
  INDEX (task_id),
  INDEX (review_text),
  FOREIGN KEY (task_id) REFERENCES task (id),
  FOREIGN KEY (applicant_id) REFERENCES users (id),
  FOREIGN KEY (employer_id) REFERENCES users (id)
);

CREATE TABLE filesbytask (
	id INT AUTO_INCREMENT,
	task_id int NOT NULL,
  file_link char(255) NOT NULL,
	PRIMARY KEY (id),
  FOREIGN KEY (task_id) REFERENCES task (id)
);