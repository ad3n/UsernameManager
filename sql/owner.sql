CREATE TABLE owners
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    ip_address VARCHAR(255) NOT NULL,
    api VARCHAR(255) NOT NULL,
    username_storage VARCHAR(255) NOT NULL
);

INSERT INTO owners (
    name,
    email,
    ip_address,
    api,
    username_storage
) VALUES (
    :name,
    :email,
    :ipAddress,
    :api,
    :username_storage
);