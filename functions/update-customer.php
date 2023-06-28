<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
$fullname = strtoupper($fullname);
$address = $_POST['address'];
$contact = $_POST['contact'];

$sql = "SELECT * FROM customers WHERE fullname = :fullname AND id != :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':fullname', $fullname);
$stmt->bindParam(':id', $id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../customer.php?type=error&message='.$name.' is already exist');
    exit;
}

$sql = "UPDATE customers SET
        fullname = :fullname,
        address = :address,
        contact = :contact
        WHERE id = :id";
        
$statement = $db->prepare($sql);
$statement->bindParam(':fullname', $fullname);
$statement->bindParam(':address', $address);
$statement->bindParam(':contact', $contact);
$statement->bindParam(':id', $id);
$statement->execute();

generate_logs('Updating Customer', $fullname.'| Customer was updated');
header('Location: ../customer.php?type=success&message=The price was updated successfully!');
exit();

?>