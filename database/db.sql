CREATE DATABASE mtwbs;
USE mtwbs;

CREATE TABLE users (
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (username)
);

CREATE TABLE customers (
  id INT NOT NULL AUTO_INCREMENT,
  fullname VARCHAR(255) NOT NULL,
  address TEXT NOT NULL,
  phone VARCHAR(12) NOT NULL,
  birthdate DATE NOT NULL,
  status VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE transactions (
  id INT NOT NULL AUTO_INCREMENT,
  cust_id INT NOT NULL,
  bill DOUBLE NOT NULL,
  consumption INT NOT NULL,
  previous INT NOT NULL,
  current INT NOT NULL,
  status VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (cust_id) REFERENCES customers (id)
);

INSERT INTO users (Username, Password) VALUES ("admin", "$2y$10$WgL2d2fzi6IiGiTfXvdBluTLlMroU8zBtIcRut7SzOB6j9i/LbA4K");
