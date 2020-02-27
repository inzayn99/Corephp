CREATE TABLE users(
uid int AUTO_INCREMENT PRIMARY KEY,
name varchar(100),
username varchar(100) UNIQUE KEY,
email varchar(100) UNIQUE KEY,
password varchar(100),
status boolean DEFAULT 0,
user_type SET('admin','user') DEFAULT 'user'
);