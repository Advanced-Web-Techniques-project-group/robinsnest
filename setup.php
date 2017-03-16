<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>

    <h3>Setting up...</h3>

<?php // Example 26-3: setup.php
  require_once 'functions.php';

createTable ('members',
    'UserID int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user  varchar(16) NOT NULL,
    pass varchar(16) NOT NULL,
    FirstName varchar(45) DEFAULT NULL,
    LastName varchar(45) DEFAULT NULL,
    Gender varchar(45) DEFAULT NULL,
    AddressLine1 varchar(45) DEFAULT NULL,
    AddressLine2 varchar(45) DEFAULT NULL,
    Country varchar(45) DEFAULT NULL,
    Postcode varchar(9) DEFAULT NULL,
    DateofBirth varchar(11) DEFAULT NULL,
    Email varchar(45) DEFAULT NULL,
    PhoneNumber varchar(11) DEFAULT NULL,
    Longitude double DEFAULT NULL,
    Latitude double DEFAULT NULL,
    LastInserted DATETIME DEFAULT CURRENT_TIMESTAMP');

  createTable('messages',
              'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              auth VARCHAR(16),
              recip VARCHAR(16),
              pm CHAR(1),
              time INT UNSIGNED,
              message VARCHAR(4096),
              INDEX(auth(6)),
              INDEX(recip(6))');

  createTable('friends',
              'user VARCHAR(16),
              friend VARCHAR(16),
              INDEX(user(6)),
              INDEX(friend(6))');

  createTable('profiles',
              'user VARCHAR(16),
              text VARCHAR(4096),
              INDEX(user(6))');

  createTable('scores',
              'Id INT AUTO_INCREMENT PRIMARY KEY, 
              UserId INT NOT NULL, CONSTRAINT Constraint_Scores_User_Id FOREIGN KEY (UserId) REFERENCES members(UserId),
              Score INT NOT NULL,
              DateCreated DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP');

  createTable('items',
  'item_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(45) DEFAULT NULL,
  price decimal(11,0) DEFAULT NULL,
  image varchar(45) DEFAULT NULL');

  createTable('order_line',
  'order_id int(11) NOT NULL DEFAULT 0 PRIMARY KEY, 
  qty  varchar(45) DEFAULT NULL,
  item_id varchar(45) NOT NULL');

  createTable('orders',
  'order_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  total varchar(45) DEFAULT NULL,
  user_id varchar(45) DEFAULT NULL');



?>

    <br>...done.
  </body>
</html>
