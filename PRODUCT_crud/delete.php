<?php
require 'db.php';

$id = $_GET['id'];

// Delete the product
$sql = "DELETE FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: index.php");
exit;
?>
