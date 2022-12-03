CREATE TABLE User(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    create_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);