<?php
include_once 'connection.php';
$id = $_POST['id'];
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!$_SESSION['id']){
    
}

$sql = "SELECT * FROM transactions WHERE user_id = :user_id AND status = 'pending' ORDER BY id DESC LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id']);
$stmt->execute();
$results = $stmt->fetchAll();

if (count($results) > 0){
    header('location: ../transaction.php?type=error&message=You have an existing transaction!');
    exit();
}
if (empty($id)){
    header('location: ../transaction.php?type=error&message=Please select a customer!');
    exit();
}


$sql = "INSERT INTO transactions (user_id, customer_id, status) VALUES (:user_id, :customer_id, 'pending')";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id']);
$stmt->bindParam(':customer_id', $id);
$stmt->execute();

generate_logs('Adding Transaction', 'New Transaction was added');
header('location: ../transaction.php?type=success&message=Transaction added successfully!');