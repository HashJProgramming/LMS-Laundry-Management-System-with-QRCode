<?php
include_once 'connection.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if($_POST['type'] == ""){
    header('Location: ../transaction.php?type=error&message=Please fill in all fields!');
     exit();
}

$id = $_SESSION['id'];
$kilo = $_POST['kilo'];
$type = $_POST['type'];

$sql = 'SELECT * FROM transactions WHERE status = "pending" AND user_id = :id';
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

$results = $stmt->fetch();
$transaction_id = $results['id'];
$status = 0;

$sql = "INSERT INTO laundry (transaction_id, kilo, type, status) VALUES (:transaction_id, :kilo, :type, :status)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':transaction_id', $transaction_id);
$stmt->bindParam(':kilo', $kilo);
$stmt->bindParam(':type', $type);
$stmt->bindParam(':status', $status);
$stmt->execute();

generate_logs('Adding Laundry', $type.'| was added');
header('Location: ../transaction.php?type=success&message=Laundry added successfully!');

?>