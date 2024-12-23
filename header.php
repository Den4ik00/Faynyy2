<?php
session_start();
?>
<div class="top-bar">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="profile.php" class="button">Особистий кабінет</a>
        <a href="logout.php" class="button">Вийти</a>
    <?php else: ?>
        <a href="login.php" class="button">Вхід</a>
        <a href="register.php" class="button">Реєстрація</a>
    <?php endif; ?>
</div>
