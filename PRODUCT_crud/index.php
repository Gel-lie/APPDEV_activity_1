<?php
// Include the database connection
require 'db.php';

// Handle form submission
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];

    // Insert data into the products table
    $sql = "INSERT INTO products (name, description, price, quantity, barcode) VALUES (:name, :description, :price, :quantity, :barcode)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'barcode' => $barcode
    ]);

    // Redirect to prevent resubmission on refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Retrieve all products from the database, including createdAt and updatedAt
$sql = "SELECT id, name, description, price, quantity, barcode, createdAt, updatedAt FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
    h1 {
        padding-top:10px ;
  text-align: center;
}
    .center {
  margin-left: auto;
  margin-right: auto;
}
.centers {
    margin-left: auto;
    margin-right: auto;
    max-width: 1000px; /* Adjust as needed */
    padding: 20px;
   
}

</style>
</head>
<body>

<h1>Product List</h1>

<!-- Form to add a new product -->
<form action="" method="post" class="centers">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="text" name="description" placeholder="Product Description" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <input type="text" name="barcode" placeholder="Barcode" required>
    <input type="submit" name="submit" value="Add Product">
</form>

<!-- Table to display the products -->
<table class="center" border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Barcode</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?= $product['id']; ?></td>
        <td><?= $product['name']; ?></td>
        <td><?= $product['description']; ?></td>
        <td><?= $product['price']; ?></td>
        <td><?= $product['quantity']; ?></td>
        <td><?= $product['barcode']; ?></td>
        <td><?= $product['createdAt']; ?></td>
        <td><?= $product['updatedAt']; ?></td>
        <td class="actions">
            <a href="edit.php?id=<?= $product['id']; ?>">Edit</a>
            <a href="delete.php?id=<?= $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
