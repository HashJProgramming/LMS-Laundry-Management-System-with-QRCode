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

if ($row['stock'] < $qty) {
    header('Location: ../supply.php?type=error&message=Cannot stock out more than the current stock!');
    exit();
}

$stock = $row['stock'] - $qty;

$sql = "UPDATE items SET stock = :stock WHERE id = :id";
$statement = $db->prepare($sql);
$statement->bindParam(':stock', $stock);
$statement->bindParam(':id', $id);
$statement->execute();

generate_logs('Stock Out', $qty.' Stock was deducted');
header('Location: ../supply.php?type=success&message=Item Stock was updated successfully!');
exit();

?>