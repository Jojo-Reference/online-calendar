<?php
/**
 * Скрипт для аутентификации через OAuth 2.0 с использованием Google.
 *
 * Этот скрипт позволяет пользователю авторизоваться через OAuth 2.0 с помощью учетных данных Google.
 * После успешной аутентификации выводится информация о пользователе.
 */

// Инициализация сессии
session_start();

// Настройки OAuth для Google
$clientID = 'YOUR_GOOGLE_CLIENT_ID';
$clientSecret = 'YOUR_GOOGLE_CLIENT_SECRET';
$redirectUri = 'http://yourdomain.com/oauth_callback.php';

// Создание объекта OAuth 2.0 для Google
$provider = new League\OAuth2\Client\Provider\Google([
    'clientId'     => $clientID,
    'clientSecret' => $clientSecret,
    'redirectUri'  => $redirectUri,
]);

// Проверка авторизации пользователя и перенаправление на страницу аутентификации Google при необходимости
if (!isset($_SESSION['access_token'])) {
    if (!isset($_GET['code'])) {
        $authUrl = $provider->getAuthorizationUrl();
        $_SESSION['oauth2state'] = $provider->getState();
        header('Location: ' . $authUrl);
        exit;
    } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
        exit('Invalid state');
    } else {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        $_SESSION['access_token'] = $token->getToken();
    }
}

// Получение данных пользователя
$user = $provider->getResourceOwner($_SESSION['access_token']);

// Вывод информации о пользователе
echo 'Привет, ' . $user->getName();