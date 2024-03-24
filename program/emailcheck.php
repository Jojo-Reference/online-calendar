<?php
/**
 * Скрипт для проверки уникальности email в базе данных.
 *
 * Этот скрипт содержит функцию для проверки уникальности email в базе данных.
 * Также включает подключение к базе данных для выполнения запросов.
 */

// Подключение к базе данных (замените данными вашей БД)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "calendar_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/**
 * Функция для проверки уникальности email в базе данных.
 *
 * @param string $email Email для проверки
 * @param mysqli $conn Объект подключения к базе данных
 * @return bool Возвращает true, если email уникален, и false, если email уже используется
 */
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