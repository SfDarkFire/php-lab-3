<?php
session_start();
include 'db.php'; // подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        setcookie('username', $user['username'], time() + (86400 * 30), '/'); // Кука на 30 дней
        header("Location: welcome.php");
        exit();
    } else {
        echo "Неверный логин или пароль.";
    }
}

// Автоматическая авторизация
if (isset($_COOKIE['username'])) {
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $_COOKIE['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: welcome.php");
        exit();
    }
}
?>

<form method="POST" action="">
    <label for="username">Логин:</label>
    <input type="text" name="username" required><br>
    <label for="password">Пароль:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Войти</button>
</form>