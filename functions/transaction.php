<?php
include_once 'connection.php';
$id = $_POST['id'];
if (!$_SESSION['id']){
    session_start();
}

$sql = "INSERT INTO transactions (user_id, customer_id, status) VALUES (:user_id, :customer_id, 0)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id']);
$stmt->bindParam(':customer_id', $id);
$stmt->execute();
header('location: ../transaction.php?type=success&message=Transaction added successfully!');