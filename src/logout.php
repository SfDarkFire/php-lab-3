<?php
session_start();
session_destroy();
setcookie('username', '', time() - 3600, '/'); // Удаляем куку
header("Location: login.php");
exit();
?>