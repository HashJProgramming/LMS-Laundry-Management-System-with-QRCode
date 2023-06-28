<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$sql = "DELETE FROM customers WHERE id = :id";
$statement = $db->prepare($sql);
$statement->bindParam(':id', $id);
$statement->execute();

header('Location: ../customer.php?type=success&message=Customer removed successfully!');