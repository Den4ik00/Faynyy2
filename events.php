<?php
include('db.php');
session_start();

$stmt = $pdo->prepare("SELECT * FROM events");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="images/Logo.jpg">
</head>
<body>
    <header>
        <div class="header-container">
            <h1><a href="index.php" class="main-title">Файний Листопад</a></h1>
        </div>
    </header>
    
    <h2>Події</h2>
    
    <!-- Перевірка на авторизацію -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="button-container">
            <a href="create_event.php" target="_blank" class="btn-regenets">Подати запит на створення події</a>
        </div>
        <hr>
    <?php endif; ?>

    <ul>
        <?php foreach ($events as $event): ?>
            <li>
                <a href="event.php?id=<?= $event['id'] ?>"><?= $event['title'] ?></a>

                <!-- Якщо користувач авторизований, то показуємо кнопку реєстрації на подію -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST" action="event.php?id=<?= $event['id'] ?>">
                        <button type="submit">Зареєструватися</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
