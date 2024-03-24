<?php
/**
 * Скрипт для регистрации нового пользователя.
 *
 * Этот скрипт обрабатывает запросы на регистрацию нового пользователя.
 * Пользователь вводит имя пользователя, email и пароль, после чего происходит проверка и сохранение данных в базу данных.
 */

// Инициализация сессии
session_start();

// Подключение к базе данных (замените данными вашей БД)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "calendar_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Хешируем пароль перед сохранением в базу данных
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Проверяем, существует ли пользователь с указанным email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Регистрируем нового пользователя
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Пользователь успешно зарегистрирован.";
        } else {
            $error_message = "Ошибка при регистрации пользователя: " . $conn->error;
        }
    } else {
        $error_message = "Пользователь с указанным email уже существует.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Заголовок страницы регистрации -->
    <title>Регистрация</title>
</head>
<body>
    <!-- Заголовок формы регистрации нового пользователя -->
    <h2>Регистрация нового пользователя</h2>

    <!-- Вывод сообщения об ошибке, если оно установлено -->
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>

    <!-- Вывод сообщения об успешной регистрации пользователя -->
    <?php if (isset($success_message)) { ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php } ?>

    <!-- Форма для ввода данных нового пользователя и отправки запроса на регистрацию -->
    <form method="post" action="">
        <label for="username">Имя пользователя:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Зарегистрироваться">
    </form>
</body>
</html>