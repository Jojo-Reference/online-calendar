<?php
/**
 * Скрипт авторизации пользователя.
 *
 * Этот скрипт проверяет введенные пользователем данные для входа в систему.
 * В случае успешной авторизации пользователь перенаправляется на страницу календаря.
 * При неудачной попытке авторизации выводится сообщение об ошибке.
 */

// Инициализация сессии
session_start();

/**
 * Проверка метода запроса и обработка данных формы.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Хардкодедные учетные данные для демонстрации
    $username = "admin";
    $password = "password";

    // Получение данных из формы
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    /**
     * Проверка учетных данных и установка флага сессии.
     */
    if ($input_username == $username && $input_password == $password) {
        // Установка флага сессии при успешной авторизации
        $_SESSION["logged_in"] = true;
        // Перенаправление на страницу календаря
        header("Location: calendar.php");
        exit();
    } else {
        // Сообщение об ошибке при неудачной авторизации
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
    <!-- Стилизация страницы (примечание: стили должны быть внутри тега <style>) -->
    <style>
        body {
            padding: 0;
            background: #99c8f7;
        }
    </style>

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