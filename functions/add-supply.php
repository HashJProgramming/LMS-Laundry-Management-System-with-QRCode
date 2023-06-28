<?php
include_once 'connection.php';

$name = $_POST['name'];
$price = $_POST['price'];
$qty = $_POST['qty'];


$sql = "SELECT * FROM items WHERE name = :name";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../supply.php?type=error&message=Item is already taken');
    exit;
}

$sql = "INSERT INTO items (name, price, stock) VALUES (:name, :price, :qty)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':qty', $qty);
$stmt->execute();

generate_logs('Adding Item', $name.'| New Item was added');
header('Location: ../supply.php?type=success&message=Item was added successfully');
