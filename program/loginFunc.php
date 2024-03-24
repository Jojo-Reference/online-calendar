<?php
/**
 * Скрипт авторизации пользователя.
 *
 * Этот скрипт обрабатывает введенные пользователем данные для входа в систему.
 * При успешной авторизации пользователь перенаправляется на страницу календаря.
 * При неудачной попытке авторизации выводится сообщение об ошибке.
 */

// Инициализация сессии
session_start();

/**
 * Функция для проверки учетных данных пользователя.
 *
 * @param string $username Имя пользователя
 * @param string $password Пароль пользователя
 * @return bool Результат проверки учетных данных (true - успешно, false - неуспешно)
 */
function login($username, $password) {
    $valid_username = "admin";
    $valid_password = "password";

    if ($username == $valid_username && $password == $valid_password) {
        $_SESSION["logged_in"] = true;
        return true;
    } else {
        return false;
    }
}

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    // Вызов функции login для проверки учетных данных
    if (login($input_username, $input_password)) {
        header("Location: calendar.php");
        exit();
    } else {
        $error_message = "Неверное имя пользователя или пароль";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Заголовок страницы авторизации -->
    <title>Авторизация</title>
</head>
<body>
    <!-- Заголовок формы авторизации -->
    <h2>Авторизация</h2>

    <!-- Вывод сообщения об ошибке, если оно установлено -->
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>

    <!-- Форма авторизации -->
    <form method="post" action="">
        <label for="username">Имя пользователя:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Войти">
    </form>
</body>
</html>