<?php
if(isset($_POST['submit'])){
    require 'db.php';

    $Name = $POST['Name'];
    $Description = $POST['Description'];
    $Price = $POST['Price'];
    $Quantity = $POST['Quantity'];
    $Barcode = $POST['Barcode'];

    $sql = "INSERT INTO product (Name, Description, Price, Quantity, Barcode) VALUES (:Name, :Description, :Price, :Quantity, :Barcode)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['Name'=>$Name, 'Description'=>$Description, 'Price'=>$Price, 'Quantity'=>$Quantity, 'Barcode'=>$Barcode]);

    header("Location: index.php");
}
?>