CREATE TABLE username
(
    username VARCHAR(12) PRIMARY KEY NOT NULL
);

INSERT INTO username (
    username
)
VALUES (
    :username
);