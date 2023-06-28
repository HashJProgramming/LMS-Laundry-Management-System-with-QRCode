<?php
include_once 'functions/connection.php';

$sql = 'SELECT * FROM prices ORDER BY price DESC';
$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();


foreach ($results as $row) {
    
    ?>
        <tr>
            <td>#<?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td class="text-center">
                <a class="mx-1" href="#" role="button" data-bs-target="#update" data-bs-toggle="modal" data-id="<?php echo $row['id']?>" data-name="<?php echo $row['name']?>" data-price="<?php echo $row['price']?>"><i class="far fa-edit text-warning" style="font-size: 20px;"></i></a>
                <a class="mx-1" href="#" role="button" data-bs-target="#remove" data-bs-toggle="modal" data-id="<?php echo $row['id']?>"><i class="far fa-trash-alt text-danger" style="font-size: 20px;"></i></a>
            </td>

        <?php
        
        ?>

    </tr>
        
<?php
}
