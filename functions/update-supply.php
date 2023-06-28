<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$name = $_POST['name'];
$price = $_POST['price'];

$sql = "SELECT * FROM items WHERE name = :name AND id != :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':id', $id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../supply.php?type=error&message='.$name.' is already exist');
    exit;
}

$sql = "UPDATE items SET
        name = :name,
        price = :price
        WHERE id = :id";
        
$statement = $db->prepare($sql);
$statement->bindParam(':name', $name);
$statement->bindParam(':price', $price);
$statement->bindParam(':id', $id);
$statement->execute();

generate_logs('Updating Item', $name.'| Item was updated');
header('Location: ../supply.php?type=success&message=Item was updated successfully!');
exit();

?>