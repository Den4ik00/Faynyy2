<?php
require_once 'vendor/autoload.php'; // Підключення Google API
session_start();


if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $token = $client->getAccessToken();
    $client->setAccessToken($token);

    $google_user = $client->verifyIdToken();

    if ($google_user) {
        $_SESSION['user_id'] = $google_user['sub'];
        $_SESSION['email'] = $google_user['email'];
        $_SESSION['name'] = $google_user['name'];

        // Перенаправлення на головну сторінку
        header("Location: index.php");
        exit();
    } else {
        echo "Помилка авторизації.";
    }
} else {
    header("Location: login.php");
    exit();
}
?>
