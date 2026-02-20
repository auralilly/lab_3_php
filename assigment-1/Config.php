<?php 
$host = "localhost"; 
$db = "teamtracker"; 
$user = "root"; 
$password = ""; 

//points to the database
$dsn = "mysql:host=$host;dbname=$db";


try {
   $pdo = new PDO ($dsn, $user, $password); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
//checking if error in the connection
catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage()); 
}