<?php
include('db.php');
require_once 'vendor/autoload.php'; // Додано для Google API

session_start();


$client->setRedirectUri('http://localhost/callback.php'); // URL перенаправлення
$client->addScope('email');
$client->addScope('profile');

// Перевіряємо, чи є вхід через Google
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
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; // Поле може містити email або номер телефону
    $password = $_POST['password'];
    $remember = isset($_POST['remember']); // Перевіряємо, чи встановлено "Запам'ятати мене"

    // Запит для перевірки, чи це email чи номер телефону
    $stmt = $pdo->prepare("
        SELECT * FROM users 
        WHERE (email = :username OR phone = :username)
    ");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];

        // Якщо вибрано "Запам'ятати мене", створюємо cookie
        if ($remember) {
            setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // Зберігаємо на 30 днів
        }

        header("Location: index.php");
        exit();
    } else {
        $error = "Невірний email, номер телефону або пароль.";
    }
}
if (isset($_POST['remember_me'])) {
    setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // Зберігати 30 днів
}

if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="images/Logo.jpg">
</head>
<body>
    <div class="header-container">
        <h1><a href="index.php" class="main-title">Файний Листопад</a></h1>
    </div>

    <div class="form-container">
        <h2>Вхід</h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <label for="username">Email або номер телефону</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" required>

            <div class="checkbox-container">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Запам'ятати мене</label>
            </div>

            <button type="submit" class="submit-button">Увійти</button>
        </form>
        <p>Немає облікового запису? <a href="register.php">Зареєструватися</a></p>

        <hr>
        <div class="google-login">
            <a href="<?= htmlspecialchars($client->createAuthUrl()) ?>" class="google-button">Увійти через Google</a>
        </div>
    </div>
</body>
</html>
