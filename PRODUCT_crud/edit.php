<?php
require 'db.php';

$id = $_GET['id'];

// Retrieve the product details to edit
$sql = "SELECT * FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();

// Handle form submission to update the product
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];

    $sql = "UPDATE products SET name = :name, description = :description, price = :price, quantity = :quantity, barcode = :barcode WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'barcode' => $barcode,
        'id' => $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>

<h1>Edit Product</h1>

<!-- Form to edit the product -->
<form action="" method="post">
    <input type="text" name="name" value="<?= $product['name']; ?>" required>
    <textarea name="description" required><?= $product['description']; ?></textarea>
    <input type="number" step="0.01" name="price" value="<?= $product['price']; ?>" required>
    <input type="number" name="quantity" value="<?= $product['quantity']; ?>" required>
    <input type="text" name="barcode" value="<?= $product['barcode']; ?>" required>
    <input type="submit" name="update" value="Update Product">
</form>

</body>
</html>
