--source setup.sql;

DROP DATABASE IF EXISTS contacts_app;

CREATE DATABASE contacts_app;

USE contacts_app;

CREATE TABLE contacts(
    Id INT AUTO_INCREMENT PRIMARY KEY, 
    Name VARCHAR(255), 
    Phone_Number VARCHAR(255)
);

INSERT INTO contacts(Name, Phone_Number) VALUES("Josue Reyes", "249-147-9428");
