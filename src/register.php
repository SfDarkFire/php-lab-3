<?php
session_start();
include 'db.php'; // подключение к базе данных
 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e-> getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([':username' => $username, ':password' =>$password])) {
        echo "Регистрация прошла успешно!";
    } else {
        echo "Ошибка регистрации.";
    }
}
?>

<form method="POST" action="">
    <label for="username">Логин:</label>
    <input type="text" name="username" required><br>
    <label for="password">Пароль:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Зарегистрироваться</button>
</form>