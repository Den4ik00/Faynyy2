<?php
session_start();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Інформація про змагання - Файний Листопад</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="images/Logo.jpg">
</head>
<body>
    <header>
        <div class="container">
        <header>
        <div class="container">
            <h1><a href="index.php" class="site-title">Файний Листопад</a></h1>
        </div>
    </header>
            <nav>
                <ul>
                    <li><a href="index.php">Головна</a></li>
                    <li><a href="events.php">Події</a></li>
                    <li><a href="competition_info.php">Інформація про змагання</a></li>
                    <li><a href="extras.php">Додатково</a></li>
                    <li><a href="regulations.php">Технічний регламент</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="dashboard.php">Особистий кабінет</a></li>
                        <li><a href="logout.php">Вихід</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Вхід</a></li>
                        <li><a href="registration.php">Реєстрація</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <h2>Інформація про змагання</h2>
            <nav>
                <ul class="dropdown">
                    <li><a href="#">Зареєстровані учасники</a></li>
                    <li><a href="#">Результати</a></li>
                    <li><a href="#">Обговорення дистанцій</a></li>
                </ul>
            </nav>

            <section class="content">
                <div class="subsection">
                    <h3>Зареєстровані учасники</h3>
                    <p>Тут ви можете побачити список усіх зареєстрованих учасників на змагання.</p>
                </div>

                <div class="subsection">
                    <h3>Результати</h3>
                    <p>Результати змагань будуть доступні після їх завершення.</p>
                </div>

                <div class="subsection">
                    <h3>Обговорення дистанцій</h3>
                    <p>Обговорення трас, складності та інших нюансів дистанцій для учасників.</p>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Файний Листопад. Всі права захищені.</p>
        </div>
    </footer>
</body>
</html>
