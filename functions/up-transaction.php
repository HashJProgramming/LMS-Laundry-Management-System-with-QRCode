<?php
include_once 'connection.php';

$id = $_POST['data_id'];

$sql = "SELECT status FROM transactions WHERE id = :id";
$statement = $db->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$result = $statement->fetch();
if($result['status'] == 0){
    header('Location: ../queue.php?type=error&message=Transaction is pending and cannot be updated.');
    exit();
}

$sql = "UPDATE transactions SET
        status = status + 1
        WHERE id = :id";
$statement = $db->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();

generate_logs('Update Transaction', $id.'| Transaction was updated to '.$status.' by '.$_SESSION['username'].'.');
header('Location: ../queue.php?type=success&message=Transaction updated successfully!');
exit();

?>