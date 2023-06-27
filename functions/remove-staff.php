<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$sql = "DELETE FROM users WHERE id = :id";
$statement = $db->prepare($sql);
$statement->bindParam(':id', $id);
$statement->execute();

header('Location: ../staff.php?type=success&message=Staff removed successfully!');