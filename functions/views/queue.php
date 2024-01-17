<?php
include_once 'functions/connection.php';
$sql = 'SELECT l.status, l.id AS laundry_id, l.kilo, p.price, p.name, p.unit, t.id, t.customer_id, t.total, l.created_at, c.fullname, ROW_NUMBER() OVER (ORDER BY status DESC, kilo ASC) AS queue_number 
        FROM laundry AS l
        JOIN prices AS p ON l.type = p.id
        JOIN transactions AS t ON l.transaction_id = t.id
        JOIN customers AS c ON t.customer_id = c.id
        WHERE l.status >= 0 AND l.status < 4';

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
            <td><?php echo $row['kilo'].' '.$row['unit'] ?></td>
            <td><?php echo $status ?></td>
            <td class="text-center">
            <?php if ($row['status'] < 5): ?>
                <a class="mx-1 text-decoration-none text-success" href="#" data-bs-target="#up" data-bs-toggle="modal" data-id="<?php echo $row['laundry_id']?>"><i class="far fa-arrow-alt-circle-up text-success" style="font-size: 20px;"></i> Proceed</a>
                <a class="mx-1 text-decoration-none <?php if($row['status'] <= 1) { echo 'd-none';}?>" href="#" data-bs-target="#down" data-bs-toggle="modal" data-id="<?php echo $row['laundry_id']?>"><i class="far fa-arrow-alt-circle-down" style="font-size: 20px;"></i> Undo</a>
                <a class="mx-1 text-decoration-none" href="tracking.php?id=<?php echo $row['id']; ?>" target="_blank"><i class="far fa-credit-card" style="font-size: 20px;"></i> Tracking</a>
                <a class="mx-1 text-decoration-none" href="invoice.php?id=<?php echo $row['id']; ?>" target="_blank"><i class="fas fa-print" style="font-size: 20px;"></i> Invoice</a>
            <?php else: ?>
                <a class="mx-1" href="#"><i class="far fa-circle text-warning" style="font-size: 20px;"></i></a>
                <a class="mx-1" href="#"><i class="far fa-circle text-warning" style="font-size: 20px;"></i></a>
                <a class="mx-1" href="tracking.php?id=<?php echo $row['id']; ?>" target="_blank"><i class="far fa-credit-card" style="font-size: 20px;"></i></a>
                <a class="mx-1" href="#" role="button" data-bs-target="#confirm" data-bs-toggle="modal" data-id="<?php echo $row['id']?>"><i class="far fa-trash-alt text-danger" style="font-size: 20px;"></i></a>
            <?php endif; ?>
            </td>
        </tr>
            
<?php
}
