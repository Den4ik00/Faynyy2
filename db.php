<?php
$host = 'localhost';
$dbname = 'tourism_site';
$username = 'root';
$password = 'root';

// Підключення до бази даних
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
