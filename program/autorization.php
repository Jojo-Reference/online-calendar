<?php
session_start();

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "admin";
    $password = "password";

    // Получаем данные из формы
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    // Проверяем введенные данные
    if ($input_username == $username && $input_password == $password) {
        $_SESSION["logged_in"] = true;
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
    <title>Авторизация</title>
</head>
<body>
    {
        padding: 0;
        background: #99c8f7;
    }
    <h2>Авторизация</h2>
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" action="">
        <label for="username">Имя пользователя:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Войти">
    </form>
</body>
</html>
