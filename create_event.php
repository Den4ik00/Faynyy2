<?php
session_start();
include('db.php');

// Перевірка авторизації
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Обробка форми
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_start_date = $_POST['event_start_date'];
    $event_end_date = $_POST['event_end_date'];

    // Перевірка, щоб обидві дати були заповнені
    if (empty($event_start_date) || empty($event_end_date)) {
        $error = "Будь ласка, вкажіть початкову та кінцеву дату події.";
    } else {
        // Вставка події в базу даних
        $stmt = $pdo->prepare("
            INSERT INTO events (title, description, event_start_date, event_end_date)
            VALUES (:title, :description, :event_start_date, :event_end_date)
        ");
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'event_start_date' => $event_start_date,
            'event_end_date' => $event_end_date
        ]);

        $success = "Подія успішно створена!";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Подати запит на створення події</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="images/Logo.jpg">
</head>
<body>
    <header>
        <div class="header-container">
        <h1><a href="index.php" class="main-title">Файний Листопад</a></h1>
    </div>
    </header>
    <h2>Подати запит на створення події</h2>
    <?php if (isset($success)): ?>
        <p><?= htmlspecialchars($success); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
    <div class="form-container">
        <label for="title">Назва події:</label>
        <input type="text" name="title" id="title" required>
        
        <label for="description">Опис події:</label>
        <textarea name="description" id="description" required></textarea>
        
        <label for="event_start_date">Дата початку події:</label>
        <input type="date" name="event_start_date" id="event_start_date" required>

        <label for="event_end_date">Дата завершення події:</label>
        <input type="date" name="event_end_date" id="event_end_date" required>

        <div class="button-container">
        <button type="submit" target="_blank" class="submit-button">Подати запит</button>
        </div>
    </div>
    </form>
</body>
</html>
