<?php
/**
 * Скрипт для восстановления пароля пользователя.
 *
 * Этот скрипт обрабатывает запросы на восстановление пароля пользователя.
 * Пользователь вводит свой email, после чего отправляются инструкции по сбросу пароля на указанный email.
 */

// Инициализация сессии
session_start();

// Подключение к базе данных
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "calendar_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/**
 * Функция для отправки письма с инструкциями по сбросу пароля.
 *
 * @param string $email Email адрес пользователя
 * @param string $resetToken Токен для сброса пароля
 */
function sendPasswordResetEmail($email, $resetToken) {
    // Здесь должна быть логика отправки письма с инструкциями по сбросу пароля
    // Например, отправка ссылки с токеном для сброса пароля на указанный email
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Проверяем, существует ли пользователь с указанным email в базе данных
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $resetToken = md5(uniqid(rand(), true)); // Генерируем уникальный токен для сброса пароля
        $sql = "UPDATE users SET reset_token = '$resetToken' WHERE email = '$email'";
        $conn->query($sql);

        sendPasswordResetEmail($email, $resetToken);

        $success_message = "Инструкции по сбросу пароля отправлены на ваш email.";
    } else {
        $error_message = "Пользователь с указанным email не найден.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Заголовок страницы восстановления пароля -->
    <title>Восстановление пароля</title>
</head>
<body>
    <!-- Заголовок формы восстановления пароля -->
    <h2>Восстановление пароля</h2>

    <!-- Вывод сообщения об ошибке, если оно установлено -->
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>

    <!-- Вывод сообщения об успешной отправке инструкций по сбросу пароля -->
    <?php if (isset($success_message)) { ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php } ?>

    <!-- Форма для ввода email и отправки инструкций по сбросу пароля -->
    <form method="post" action="">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        <input type="submit" value="Отправить инструкции по сбросу пароля">
    </form>
</body>
</html>