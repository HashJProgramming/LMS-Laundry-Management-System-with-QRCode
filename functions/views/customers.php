<?php
include_once 'functions/connection.php';

$sql = 'SELECT * FROM customers ORDER BY fullname ASC';
$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();


foreach ($results as $row) {
$fullname = $row['fullname'];
$fullname = explode(' ', $fullname);
$firstname = $fullname[0];
$lastname = $fullname[1];
?>
    <tr>
        <td>#<?php echo $row['id']; ?></td>
        <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png"><?php echo $row['fullname']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['contact']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
        <td class="text-center">
            <a class="mx-1" href="profile-customer.php?id=<?php echo $row['id'] ?>"><i class="far fa-eye" style="font-size: 20px;"></i></a>
            <a class="mx-1" href="#" data-bs-target="#update" data-bs-toggle="modal" data-id="<?php echo $row['id']?>" data-firstname="<?php echo $firstname ?>" data-lastname="<?php echo $lastname ?>" data-address="<?php echo $row['address'] ?>" data-contact="<?php echo $row['contact'] ?>" ><i class="far fa-edit text-warning" style="font-size: 20px;"></i></a>
            <a class="mx-1" href="#" data-bs-target="#remove" data-bs-toggle="modal" data-id="<?php echo $row['id']?>"><i class="far fa-trash-alt text-danger" style="font-size: 20px;"></i></a>
        </td>

        <?php

        ?>

    </tr>

<?php
}
