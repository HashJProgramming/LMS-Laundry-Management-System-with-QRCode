<?php
include_once 'connection.php';

$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
$fullname = strtoupper($fullname);

$address = $_POST['address'];
$contact = $_POST['contact'];

$sql = "SELECT * FROM customers WHERE fullname = :fullname";
$stmt = $db->prepare($sql);
$stmt->bindParam(':fullname', $fullname);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../customer.php?type=error&message='.$fullname.' is already exist');
    exit;
}

$sql = "INSERT INTO customers (fullname, address, contact) VALUES (:fullname, :address, :contact)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':fullname', $fullname);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':contact', $contact);
$stmt->execute();


header('Location: ../customer.php?type=success&message=New customer was added successfully');
?>