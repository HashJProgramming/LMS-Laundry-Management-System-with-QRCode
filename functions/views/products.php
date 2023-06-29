<?php
include_once 'functions/connection.php';
if (!$_SESSION['id']){
    session_start();
}
$user_id = $_SESSION['id'];

$sql = 'SELECT ex.id, ex.qty, ex.created_at, i.name, i.price
        FROM expenditures AS ex
        JOIN items AS i ON ex.item_id = i.id
        JOIN transactions AS t ON ex.transaction_id = t.id
        WHERE ex.user_id = :user_id AND t.status = 0';

$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$results = $stmt->fetchAll();

foreach ($results as $row) {

?>
    <tr>
        <td>#<?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td>₱<?php echo $row['price']; ?></td>
        <td><?php echo $row['qty']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
        
        <td class="text-center">
            <a class="mx-1" href="#" data-bs-target="#remove" data-bs-toggle="modal" data-id="<?php echo $row['id']?>" ><i class="far fa-trash-alt text-danger" style="font-size: 20px;"></i></a>
        </td>  

        <?php

        ?>

    </tr>

<?php
}
