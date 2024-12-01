<?php
$host = "MySQL-8.2"; 
$db   = "php_3"; // Имя базы данных
$user = "root";          // Имя пользователя БД
$pass = "";              // Пароль

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Не удалось подключиться к базе данных: " . $e->getMessage());
}
?>