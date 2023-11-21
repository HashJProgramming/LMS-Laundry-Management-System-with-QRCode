<?php
include_once 'functions/connection.php';

$sql = 'SELECT t.id, l.kilo, l.status AS stats, p.price, p.name, t.status, t.created_at, u.username, c.fullname 
        FROM transactions AS t 
        JOIN laundry AS l ON l.transaction_id = t.id
        JOIN prices AS p ON l.type = p.id
        JOIN customers AS c ON t.customer_id = c.id
        JOIN users AS u ON t.user_id = u.id 
        WHERE t.status = "completed";';
$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();
 
foreach ($results as $row) {
    if($row['stats'] == 0){
    $status = 'Pending';
    }else if($row['stats'] == 1){
        $status = 'Processing';
    }else if($row['stats'] == 2){
        $status = 'Folding';
    }else if($row['stats'] == 3){
        $status = 'Ready for Pickup';
    }else if($row['stats'] == 4){
        $status = 'Claimed';
    }else{
        $status = 'Unknown';
    }

    echo '<tr>';
    ?>
        <td><a class="mx-1 text-decoration-none" target="_blank" href="reciept.php?id=<?php echo $row['id'] ?>&type=view"><i class="fas fa-print" style="font-size: 20px;"></i> <?= $row['id'] ?></a></td>
    <?php
    echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">' . $row['fullname'] . '</td>';
    echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">' . $row['username'] . '</td>';
    echo '<td>' . $row['kilo'] . '</td>';
    echo '<td>' . $row['name'] . ' - ₱'.number_format($row['price'],2).'</td>';
    echo '<td>₱' . number_format($row['price'] * $row['kilo'], 2) . '</td>';
    echo '<td>' . $status. '</td>';
    echo '<td>' . $row['created_at'] . '</td>';
    echo '</tr>';
}
