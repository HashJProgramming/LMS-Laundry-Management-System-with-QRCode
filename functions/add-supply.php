<?php
include_once 'connection.php';

$name = $_POST['name'];
$unit = $_POST['unit'];
$qty = $_POST['qty'];


$sql = "SELECT * FROM items WHERE name = :name";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../supply.php?type=error&message=Item is already taken');
    exit;
}

$sql = "INSERT INTO items (name, unit, stock) VALUES (:name, :unit, :qty)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':unit', $unit);
$stmt->bindParam(':qty', $qty);
$stmt->execute();

generate_logs('Adding Item', $name.'| New Item was added');
header('Location: ../supply.php?type=success&message=Item was added successfully');
