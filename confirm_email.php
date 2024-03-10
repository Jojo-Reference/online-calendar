<?php
// Подключение к базе данных
// Проверка наличия токена в запросе
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Поиск токена в базе данных
    $sql = "SELECT * FROM email_confirmations WHERE token = '$token'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        
        // Обновление статуса пользователя в базе данных
        $sql_update = "UPDATE users SET email_verified = 1 WHERE id = '$user_id'";
        $conn->query($sql_update);
        
        // Удаление токена из базы данных
        $sql_delete = "DELETE FROM email_confirmations WHERE token = '$token'";
        $conn->query($sql_delete);
        
        echo "Ваша электронная почта успешно подтверждена.";
    } else {
        echo "Недействительный токен подтверждения.";
    }
} else {
    echo "Отсутствует токен подтверждения.";
}
?>