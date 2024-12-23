<?php
session_start();
session_unset();
session_destroy();
setcookie('user_id', '', time() - 3600, "/"); // Видалення куки
header("Location: login.php");
exit();
?>
