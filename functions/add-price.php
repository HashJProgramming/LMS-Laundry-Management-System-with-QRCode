<?php
include_once 'connection.php';

$name = $_POST['type'];
$price = $_POST['price'];

$sql = "SELECT * FROM prices WHERE name = :name";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../profile.php?type=error&message=The '.$type.' is already exist');
    exit;
}

$sql = "INSERT INTO prices (name, price) VALUES (:name, :price)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':price', $price);
$stmt->execute();


header('Location: ../profile.php?type=success&message=The price was added successfully');

?>