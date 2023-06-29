<?php
include_once 'functions/connection.php';

$sql = 'SELECT Transactions.id, Transactions.kilo, Transactions.total, Transactions.status, Transactions.created_at, users.username, customers.fullname 
        FROM Transactions 
        JOIN users ON Transactions.user_id = users.id 
        JOIN customers ON Transactions.customer_id = customers.id 
        WHERE Transactions.status = 4;';
$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();

foreach ($results as $row) {
    if($row['status'] == 0){
        $status = 'Pending';
    }else if($row['status'] == 1){
        $status = 'Processing';
    }else if($row['status'] == 2){
        $status = 'Folding';
    }else if($row['status'] == 3){
        $status = 'Ready for Pickup';
    }else if($row['status'] == 4){
        $status = 'Claimed';
    }else{
        $status = 'Unknown';
    }

    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">' . $row['fullname'] . '</td>';
    echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">' . $row['username'] . '</td>';
    echo '<td>' . $row['kilo'] . '</td>';
    echo '<td>' . $row['total'] . '</td>';
    echo '<td>' . $status. '</td>';
    echo '<td>' . $row['created_at'] . '</td>';
    echo '</tr>';
}
