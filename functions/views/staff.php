<?php
include_once 'functions/connection.php';

$sql = 'SELECT * FROM users WHERE level = 1 ORDER BY id DESC';
$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();


foreach ($results as $row) {
    


    ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png"><?php echo $row['username']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td class="text-center">
                <a class="mx-1 text-decoration-none" href="profile-staff.php?id=<?php echo $row['id']?>" role="button"><i class="far fa-eye" style="font-size: 20px;"></i> View Transactions</a>
                <a class="mx-1 text-decoration-none text-warning" href="#" role="button" data-bs-target="#update" data-bs-toggle="modal" data-id="<?php echo $row['id']?>" data-username="<?php echo $row['username']?>"><i class="far fa-edit text-warning" style="font-size: 20px;"></i> Update</a>
                <a class="mx-1 text-decoration-none text-danger" href="#" role="button" data-bs-target="#remove" data-bs-toggle="modal" data-id="<?php echo $row['id']?>"><i class="far fa-trash-alt text-danger" style="font-size: 20px;"></i> Remove</a>
            </td>

        <?php
        
        ?>

    </tr>
        
<?php
}
