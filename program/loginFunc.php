<?php
session_start();

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
    <title>Авторизация</title>
</head>
<body>
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
