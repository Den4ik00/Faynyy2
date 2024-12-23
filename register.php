<?php
session_start();

// Параметри підключення до бази даних
$host = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "tourism_site";

// Підключення до бази даних
$conn = new mysqli($host, $db_username, $db_password, $db_name);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

// Обробка даних із форми
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    // Перевірка збігу паролів
    if ($password !== $confirm_password) {
        echo "Паролі не збігаються!";
        exit();
    }

    // Хешування пароля
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // SQL-запит для вставки користувача
    $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Реєстрація успішна! <a href='login.php'>Увійти</a>";
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }
}

// Закриття з'єднання
$conn->close();
?>


<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="header-container">
        <h1><a href="index.php" class="main-title">Файний Листопад</a></h1>
    </div>
    <div class="form-container">
        <h2>Реєстрація</h2>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Ім'я та Прізвище користувача" required>
            <input type="email" name="email" placeholder="Електронна пошта" required>
            <input type="tel" name="phone" placeholder="Номер телефону" required pattern="[0-9+()-\s]{10,15}">
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="password" name="confirm_password" placeholder="Підтвердіть пароль" required>
            <button type="submit" class="submit-button">Зареєструватись</button>
        </form>
    </div>
</body>
</html>
