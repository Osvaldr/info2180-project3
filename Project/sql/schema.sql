DROP DATABASE IF EXISTS mail;
CREATE DATABASE mail;
USE mail;

CREATE TABLE Users (
    id INT AUTO_INCREMENT,
    firstname VARCHAR(32),
    lastname VARCHAR(32),
    username VARCHAR(32),
    password VARCHAR (64),
    PRIMARY KEY (id)
);

CREATE TABLE Messages (
    id INT AUTO_INCREMENT,
    recipient_ids INT,
    sender_id INT,
    subject VARCHAR(32),
    body VARCHAR (255),
    date_sent date,
    PRIMARY KEY (id)
);

CREATE TABLE Messages_read (
    id INT AUTO_INCREMENT,
    message_id INT,
    sender_id INT,
    date_read date,
    PRIMARY KEY (id)
);

INSERT INTO Users (username, password) VALUES ('admin', 'password123');
/*Need to hash password*/