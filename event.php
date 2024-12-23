<?php
session_start();
include('db.php');

if (!isset($_GET['id'])) {
    echo "Подія не знайдена.";
    exit();
}

$event_id = $_GET['id'];

// Отримання даних про подію
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = :id");
$stmt->execute(['id' => $event_id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    echo "Подія не знайдена.";
    exit();
}

// Реєстрація на подію
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $stmt = $pdo->prepare("
        INSERT INTO event_registrations (user_id, event_id)
        VALUES (:user_id, :event_id)
    ");
    $stmt->execute([
        'user_id' => $_SESSION['user_id'],
        'event_id' => $event_id
    ]);

    $success = "Ви успішно зареєструвалися на подію!";
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Подія: <?= htmlspecialchars($event['title']); ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="images/Logo.jpg">
</head>
<body>
    <header>
        <div class="header-container">
        <h1><a href="index.php" class="main-title">Файний Листопад</a></h1>
    </div>
    </header>
    <h1><?= htmlspecialchars($event['title']); ?></h1>
    <p><?= htmlspecialchars($event['description']); ?></p>
    <p><strong>Дата:</strong> <?= htmlspecialchars($event['event_start_date event_end_date' ]); ?></p>

    <?php if (isset($success)): ?>
        <p><?= htmlspecialchars($success); ?></p>
    <?php else: ?>
        <form method="POST" action="">
            <button type="submit">Зареєструватися</button>
        </form>
    <?php endif; ?>
</body>
</html>
