<?php
include_once 'connection.php';
session_start();

$sql = "SELECT * FROM transactions WHERE user_id = :user_id AND status = 0 ORDER BY id DESC LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id']);
$stmt->execute();
$results = $stmt->fetchAll();

$transaction_id = $results[0]['id'];
if (count($results) == 0){
    header('location: ../transaction.php?type=error&message=No transaction found!');
    exit();
}

$id = $_POST['id'];
$kilo = $_POST['kilo'];
$type = $_POST['type'];



$sql = "SELECT expenditures.id, expenditures.qty, items.name, items.price, (expenditures.qty * items.price) AS total
        FROM expenditures
        JOIN items ON expenditures.item_id = items.id
        WHERE expenditures.transaction_id = :transaction_id AND user_id = :user_id";

$stmt = $db->prepare($sql);
$stmt->bindParam(':transaction_id', $transaction_id);
$stmt->bindParam(':user_id', $_SESSION['id']);
$stmt->execute();
$results = $stmt->fetchAll();

$item_total = 0;
foreach ($results as $result){
    $item_total += $result['total'];
}

// get price from prices
$sql = "SELECT * FROM prices WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $type);
$stmt->execute();
$results = $stmt->fetchAll();

$price_name = $results[0]['name'];
$price = ($results[0]['price'] * $kilo);
$total = $item_total + $price;

$sql = "UPDATE transactions SET kilo = :kilo, total = :total, type = :type, status = status + 1 WHERE id = :id AND status = 0";
$stmt = $db->prepare($sql);
$stmt->bindParam(':kilo', $kilo);
$stmt->bindParam(':total', $total);
$stmt->bindParam(':type', $type);
$stmt->bindParam(':id', $transaction_id);
$stmt->execute();

echo $id;
echo "<br>";
echo $price;
echo "<br>";
echo $item_total;
echo "<br>";
echo $kilo;
echo "<br>";
echo $total;


generate_logs('New Pending Transaction', $_SESSION['id'].' added a new pending transaction');
header('location: ../reciept.php?id='.$transaction_id.'&kilo='.$kilo.'&type='.$price_name.'&type_price='.$price.'&products='.$item_total.'&total='.$total);