<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$name = $_POST['type'];
$unit = $_POST['unit'];
$price = $_POST['price'];

$sql = "SELECT * FROM prices WHERE name = :name AND id != :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':id', $id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../profile.php?type=error&message='.$name.' is already exist');
    exit;
}

$sql = "UPDATE prices SET
        name = :name,
        unit = :unit,
        price = :price
        WHERE id = :id";
        
$statement = $db->prepare($sql);
$statement->bindParam(':name', $name);
$statement->bindParam(':unit', $unit);
$statement->bindParam(':price', $price);
$statement->bindParam(':id', $id);
$statement->execute();

generate_logs('Updating Price', $name.'| Price was updated');
header('Location: ../profile.php?type=success&message=The price was updated successfully!');
exit();

?>