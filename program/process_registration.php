<?php

/**
 * Проверка reCAPTCHA для формы.
 * Этот скрипт отправляет запрос на сервер Google reCAPTCHA для проверки,
 * что пользователь не является роботом.
 */
/**
 * Секретный ключ для взаимодействия с Google reCAPTCHA.
 * 
 * @var string
 */
$recaptcha_secret = "YOUR_SECRET_KEY";
/**
 * Ответ reCAPTCHA, полученный из формы.
 * 
 * @var string
 */
$recaptcha_response = $_POST['g-recaptcha-response'];
/**
 * URL-адрес API Google reCAPTCHA для проверки ответа.
 * 
 * @var string
 */
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
/**
 * Данные для отправки в Google reCAPTCHA API.
 * 
 * @var array
 */
$recaptcha_data = array(
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response
);
/**
 * Настройки контекста потока для HTTP-запроса.
 * 
 * @var array
 */
$recaptcha_options = array(
    'http' => array(
        'method' => 'POST',
        'content' => http_build_query($recaptcha_data)
    )
);
/**
 * Контекст потока, созданный на основе опций для HTTP-запроса.
 * 
 * @var resource
 */
$recaptcha_context = stream_context_create($recaptcha_options);

/**
 * Результат запроса к Google reCAPTCHA API.
 * 
 * @var string
 */
$recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);

/**
 * Декодированные данные ответа от Google reCAPTCHA API.
 * 
 * @var object
 */
$recaptcha_response_data = json_decode($recaptcha_result);

/**
 * Проверка успешности верификации reCAPTCHA.
 */
if (!$recaptcha_response_data->success) {
    die("reCAPTCHA verification failed.");
}

// Далее обработка данных формы и регистрация пользователя
// ...

?>