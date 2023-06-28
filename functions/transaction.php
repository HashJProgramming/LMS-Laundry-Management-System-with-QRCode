<?php
include_once 'connection.php';
$id = $_POST['id'];
if (!$_SESSION['id']){
    session_start();
}

$sql = "SELECT * FROM transactions WHERE user_id = :user_id AND status = 0 ORDER BY id DESC LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id']);
$stmt->execute();
$results = $stmt->fetchAll();

if (count($results) > 0){
    header('location: ../transaction.php?type=error&message=You have an existing transaction!');
    exit();
}

$sql = "INSERT INTO transactions (user_id, customer_id, status) VALUES (:user_id, :customer_id, 0)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id']);
$stmt->bindParam(':customer_id', $id);
$stmt->execute();
header('location: ../transaction.php?type=success&message=Transaction added successfully!');