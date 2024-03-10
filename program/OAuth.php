<?php
require 'vendor/autoload.php'; // Подключаем библиотеку OAuth 2.0

session_start();

// Настройки OAuth для Google
$clientID = 'YOUR_GOOGLE_CLIENT_ID';
$clientSecret = 'YOUR_GOOGLE_CLIENT_SECRET';
$redirectUri = 'http://yourdomain.com/oauth_callback.php';

// Создаем объект OAuth 2.0
$provider = new League\OAuth2\Client\Provider\Google([
    'clientId'     => $clientID,
    'clientSecret' => $clientSecret,
    'redirectUri'  => $redirectUri,
]);

// Если пользователь не авторизован, перенаправляем на страницу аутентификации Google
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

// Получаем данные пользователя
$user = $provider->getResourceOwner($_SESSION['access_token']);

// Выводим информацию о пользователе
echo 'Привет, ' . $user->getName();