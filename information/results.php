<?php
session_start();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результати</title>
    <link rel="stylesheet" href="/css/styles.css">
    <script defer src="results.js"></script>
    <link rel="icon" type="image/x-icon" href="/images/Logo.jpg">
</head>
<body>
    <!-- Заголовок -->
    <header>
        <div class="header-container">
        <h1><a href="/index.php" class="main-title">Файний Листопад</a></h1>
    </div>
    </header>

    <!-- Основний вміст -->
    <section>
        <div class="container">
            <h2>Результати попередніх змагань</h2>
            <table class="results-table">
                <thead>
                    <tr>
                        <th>Місце</th>
                        <th>Ім'я</th>
                        <th>Змагання</th>
                        <th>Рік</th>
                    </tr>
                </thead>
                <tbody id="results-list">
                    <!-- Дані про результати будуть додаватися динамічно -->
                </tbody>
            </table>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Файний Листопад. Всі права захищені.</p>
        </div>
    </footer>
</body>
</html>
