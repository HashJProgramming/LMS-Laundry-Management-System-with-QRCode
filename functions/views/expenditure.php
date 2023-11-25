<?php
include_once 'functions/connection.php';

$sql = 'SELECT e.id, e.qty, e.transaction_id, e.created_at, i.name, u.username
        FROM expenditures e
        JOIN items i ON e.item_id = i.id
        JOIN users u ON e.user_id = u.id 
        JOIN transactions t ON e.transaction_id = t.id
        WHERE t.status = "completed";';

$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();


foreach ($results as $row) {
    ?>
        <tr>
            <td>#<?php echo $row['id']; ?></td>
            <td><?php echo $row['transaction_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['qty']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        <?php
        
        ?>

    </tr>
        
<?php
}
