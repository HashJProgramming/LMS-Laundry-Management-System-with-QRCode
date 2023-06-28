<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$name = $_POST['type'];
$price = $_POST['price'];

// check if the type is already exist
$sql = "SELECT * FROM prices WHERE name = :name AND id != :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':id', $id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../profile.php?type=error&message=The '.$type.' is already exist');
    exit;
}

$sql = "UPDATE prices SET
        name = :name,
        price = :price
        WHERE id = :id";
        
$statement = $db->prepare($sql);
$statement->bindParam(':name', $name);
$statement->bindParam(':price', $price);
$statement->bindParam(':id', $id);
$statement->execute();

header('Location: ../profile.php?type=success&message=The price was updated successfully!');
exit();

?>