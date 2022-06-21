<?php
require_once 'config.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $host successfully.";

    $check_users = $conn->query('SHOW TABLES LIKE "users"');

   if($check_users->rowCount() == 0) {
       $sql = "create table users (id integer auto_increment primary key, login varchar(30),email varchar(30), password varchar(255));";
       $conn->exec($sql);
   }

} catch (PDOException $pe) {
    echo "Database error: " . $pe->getMessage();
}

session_start(); // Создаем сессию для авторизации
?>

