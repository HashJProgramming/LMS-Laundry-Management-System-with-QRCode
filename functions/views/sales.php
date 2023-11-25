<?php
include_once 'functions/connection.php';

$sql = 'SELECT t.id, t.total, t.created_at, u.username, c.fullname 
        FROM transactions AS t 
        JOIN customers AS c ON t.customer_id = c.id
        JOIN users AS u ON t.user_id = u.id 
        WHERE t.status = "completed";'; 
$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();
 
foreach ($results as $row) {
    echo '<tr>';
    ?>
        <td><a class="mx-1 text-decoration-none" target="_blank" href="reciept.php?id=<?php echo $row['id'] ?>&type=view"><i class="fas fa-print" style="font-size: 20px;"></i> <?= $row['id'] ?></a></td>
    <?php
    echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">' . $row['fullname'] . '</td>';
    echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">' . $row['username'] . '</td>';
    echo '<td>₱' . number_format($row['total'], 2) . '</td>';
    echo '<td>' . $row['created_at'] . '</td>';
    echo '</tr>';
}
