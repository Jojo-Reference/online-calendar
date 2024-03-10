<?php
// Подключение к базе данных (замените данными вашей БД)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "calendar_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function isEmailUnique($email, $conn) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return false; // Email уже используется
    } else {
        return true; // Email уникален
    }
}

// Пример использования функции для проверки уникальности email
$email = "example@example.com";
if (isEmailUnique($email, $conn)) {
    echo "Email уникален";
} else {
    echo "Email уже используется";
}
?>
