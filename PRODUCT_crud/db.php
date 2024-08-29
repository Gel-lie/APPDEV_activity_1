<?php
// Database configuration
$host = 'localhost';  // Your database host
$dbname = 'product';  // Your database name
$username = 'root';  // Your database username
$password = '';  // Your database password

// PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

