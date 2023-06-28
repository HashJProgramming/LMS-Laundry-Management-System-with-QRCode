<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$sql = "DELETE FROM price WHERE id = :id";
$statement = $db->prepare($sql);
$statement->bindParam(':id', $id);
$statement->execute();

header('Location: ../price.php?type=success&message=Price removed successfully!');