<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $is_logged_in = false;
} else {
    $is_logged_in = true;
}
if (!isset($_SESSION['user_id'])) {
    $is_logged_in = false;
} else {
    $is_logged_in = true;
    $user_name = $_SESSION['name'] ?? 'Гість';
    $user_email = $_SESSION['email'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Файний Листопад</title>
    <link rel="icon" type="image/x-icon" href="images/Logo.jpg">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Верхня панель -->
    <div class="top-bar">
        <?php if ($is_logged_in): ?>
            <a href="profile.php" class="button">Особистий кабінет</a>
            <a href="logout.php" class="button">Вийти</a>
        <?php else: ?>
            <a href="login.php" class="button">Вхід</a>
            <a href="register.php" class="button">Реєстрація</a>
        <?php endif; ?>
    </div>

    <!-- Заголовок -->
    <div class="header-container">
        <h1> <a href="index.php" class="main-title"> Файний Листопад </a></h1>
    </div>

    <div class="social-icons">
    <a href="https://t.me/faynyi_lystopad" target="_blank" class="social-icon telegram">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Telegram_logo.svg/512px-Telegram_logo.svg.png" alt="Telegram">
    </a>
    <a href="https://www.instagram.com/faynyy_lystopad/" target="_blank" class="social-icon instagram">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Instagram_logo_2022.svg/600px-Instagram_logo_2022.svg.png" alt="Instagram">
    </a>
</div>


    <!-- Меню -->
    <div class="menu-container">
        <button id="menu-toggle">☰ Меню</button>
        <ul class="menu">
            <li><a href="events.php">Події</a></li>
            <li class="dropdown">
                <a href="#">Інформація про змагання</a>
                <ul class="dropdown-menu">
                    <li><a href="information/reg_people.php">Зареєстровані учасники</a></li>
                    <li><a href="information/results.php">Результати</a></li>
                    <li><a href="information/discussion.php">Обговорення дистанцій</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Додатково</a>
                <ul class="dropdown-menu">
                    <li><a href="extrass/merch.php">Мерч</a></li>
                    <li><a href="extrass/rent.php">Оренда спорядження</a></li>
                    <li><a href="extrass/transfer.php">Трансфер</a></li>
                </ul>
            </li>
            <li><a href="rules.php">Технічний регламент</a></li>
        </ul>
    </div>

    <script src="js/menu.js"></script>

    <!-- Основний вміст -->
    <section>
        <div class="container">
            <img src="/images/Logo.jpg" alt="Файний Листопад" class="main-image">
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Файний Листопад. Всі права майже захищені.😂</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
