<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$sql = "DELETE FROM items WHERE id = :id";
$statement = $db->prepare($sql);
$statement->bindParam(':id', $id);
$statement->execute();

header('Location: ../supply.php?type=success&message=Item removed successfully!');