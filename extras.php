<?php
session_start();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додатково - Файний Листопад</title>
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
            <h2>Додатково</h2>
            <nav>
                <ul class="dropdown">
                    <li><a href="#">Мерч</a></li>
                    <li><a href="#">Оренда спорядження</a></li>
                    <li><a href="#">Трансфер</a></li>
                </ul>
            </nav>

            <section class="content">
                <div class="subsection">
                    <h3>Мерч</h3>
                    <p>Ви можете придбати ексклюзивний мерч з нашою символікою.</p>
                </div>

                <div class="subsection">
                    <h3>Оренда спорядження</h3>
                    <p>Ми надаємо можливість оренди туристичного спорядження для змагань.</p>
                </div>

                <div class="subsection">
                    <h3>Трансфер</h3>
                    <p>Організація транспорту для учасників змагань для зручності переміщення.</p>
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
