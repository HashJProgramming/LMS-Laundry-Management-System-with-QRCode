<?php
include_once 'functions/connection.php';
if (!$_SESSION['id']){
    session_start();
}
$user_id = $_SESSION['id'];

$sql = 'SELECT l.id, l.kilo, l.type, p.name AS type, p.price AS price, p.unit
        FROM laundry AS l
        JOIN transactions AS t ON l.transaction_id = t.id
        JOIN prices AS p ON l.type = p.id
        WHERE t.user_id = :user_id AND t.status = "pending"';

$stmt = $db->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$results = $stmt->fetchAll();

foreach ($results as $row) {

?>
    <tr>
        <td><i class="fas fa-shopping-basket text-gray-600"></i>  <?php echo $row['kilo'].' '.$row['unit']; ?></td>
        <td><?php echo $row['type']; ?>  ₱<?php echo number_format($row['price'] * $row['kilo'], 2)?></td>
        <td>₱<?php echo number_format($row['price'], 2)?></td>
        <td class="text-center">
        <a class="mx-1" href="#" data-bs-target="#laundry-remove" data-bs-toggle="modal" data-id="<?php echo $row['id']?>" ><i class="far fa-trash-alt text-danger" style="font-size: 20px;"></i></a>
        </td>  

        <?php

        ?>

    </tr>

<?php
}
