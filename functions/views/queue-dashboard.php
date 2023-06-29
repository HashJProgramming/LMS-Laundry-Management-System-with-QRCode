<?php
include_once 'functions/connection.php';
$sql = 'SELECT t.status, t.id, t.kilo, t.total, t.total, t.created_at, c.fullname, ROW_NUMBER() OVER (ORDER BY status DESC, kilo ASC) AS queue_number 
        FROM Transactions AS t
        JOIN customers AS c ON t.customer_id = c.id
        WHERE t.status < 4
        ';

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
    ?>
        <tr>
            <td><?php echo $row['queue_number']; ?></td>
            <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png"><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['kilo']; ?></td>
            <td><?php echo $row['total']; ?></td>
            <td><?php echo $status ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
            
<?php
}
