<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$name = $_POST['name'];
$unit = $_POST['unit'];

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
        unit = :unit
        WHERE id = :id";
        
$statement = $db->prepare($sql);
$statement->bindParam(':name', $name);
$statement->bindParam(':unit', $unit);
$statement->bindParam(':id', $id);
$statement->execute();

generate_logs('Updating Item', $name.'| Item was updated');
header('Location: ../supply.php?type=success&message=Item was updated successfully!');
exit();

?>