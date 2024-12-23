<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $user_id = $_SESSION['user_id'];

    // Отримуємо поточний пароль з бази даних
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Перевіряємо поточний пароль
    if (password_verify($current_password, $user['password'])) {
        // Оновлюємо пароль
        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute(['password' => $new_password_hash, 'id' => $user_id]);
        echo "Пароль успішно змінено!";
    } else {
        echo "Невірний поточний пароль.";
    }
}
?>

<form action="change_password.php" method="POST">
    <input type="password" name="current_password" placeholder="Поточний пароль" required>
    <input type="password" name="new_password" placeholder="Новий пароль" required>
    <button type="submit">Змінити пароль</button>
</form>
