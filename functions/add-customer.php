<?php
include_once 'connection.php';

$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
$fullname = strtoupper($fullname);

$address = $_POST['address'];
$contact = $_POST['contact'];

$sql = "SELECT * FROM customers WHERE fullname = :fullname OR contact = :contact";
$stmt = $db->prepare($sql);
$stmt->bindParam(':fullname', $fullname);
$stmt->bindParam(':contact', $contact);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../customer.php?type=error&message='.$fullname.' is already exist or contact number is already exist');
    exit;
}

$sql = "INSERT INTO customers (fullname, address, contact) VALUES (:fullname, :address, :contact)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':fullname', $fullname);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':contact', $contact);
$stmt->execute();

generate_logs('Adding Customer', $fullname.'| New Customer was added');
header('Location: ../customer.php?type=success&message=New customer was added successfully');
?>