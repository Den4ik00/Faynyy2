<?php
session_start();
if (isset($_SESSION['user_id'])) {
    echo "Ви увійшли. Ваш ID: " . $_SESSION['user_id'];
} else {
    echo "Ви не авторизовані.";
}
?>
