<?php
session_start();
include('db.php');

// Перевірка авторизації
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Отримання даних користувача
$stmt = $pdo->prepare("SELECT email, phone, username FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Користувача не знайдено.";
    exit();
}

// Обробка форми зміни пароля
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Перевірка старого пароля
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($old_password, $user_data['password'])) {
        // Хешування нового пароля
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Оновлення пароля в базі
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute([
            'password' => $hashed_password,
            'id' => $_SESSION['user_id']
        ]);
        $success = "Пароль успішно змінено!";
    } else {
        $error = "Старий пароль введено неправильно.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Особистий кабінет</title>
    <link rel="icon" type="image/x-icon" href="images/Logo.jpg">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="header-container">
        <h1><a href="index.php" class="main-title">Файний Листопад</a></h1>
    </div>
    </header>
    <div class="header-container">
        <h1>Особистий кабінет</h1>
    </div>
    <div class="form-container">
        <h2>Ваші дані</h2>
        <p><strong>Ім'я:</strong> <?= htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
        <p><strong>Телефон:</strong> <?= htmlspecialchars($user['phone']); ?></p>
        
        <hr>
        <h2>Змінити пароль</h2>
        <?php if (isset($success)): ?>
            <p class="success-message"><?= htmlspecialchars($success); ?></p>
        <?php elseif (isset($error)): ?>
            <p class="error-message"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="profile.php" method="POST">
            <label for="old_password">Старий пароль</label>
            <input type="password" name="old_password" id="old_password" required>
            
            <label for="new_password">Новий пароль</label>
            <input type="password" name="new_password" id="new_password" required>
            
            <button type="submit" class="submit-button">Змінити пароль</button>
        </form>
        <a href="logout.php">Вийти</a>
    </div>
</body>
</html>
