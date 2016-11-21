CREATE TABLE username
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    owner_id INT(11) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    username VARCHAR(12) NOT NULL,
    birth_day DATE NOT NULL
);