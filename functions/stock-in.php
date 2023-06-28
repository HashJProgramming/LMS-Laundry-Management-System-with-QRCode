<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$qty = $_POST['qty'];

if ($qty < 0) {
    header('Location: ../supply.php?type=error&message=Invalid quantity!');
    exit();
}

$sql = "SELECT * FROM items WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stock = $qty + $row['stock'];

$sql = "UPDATE items SET stock = :stock WHERE id = :id";
$statement = $db->prepare($sql);
$statement->bindParam(':stock', $stock);
$statement->bindParam(':id', $id);
$statement->execute();
generate_logs('Stock In', $qty.' Stock was added');

header('Location: ../supply.php?type=success&message=Item Stock was updated successfully!');
exit();

?>