<?php
include_once 'connection.php';

$id = $_POST['data_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$newpassword = $_POST['newpassword'];


if ($password != $newpassword) {
    header('Location: ../staff.php?type=error&message=Password does not match!');
    exit();
}

$sql = "UPDATE users SET
    username = :username,
    password = :password
        WHERE id = :id";
        
$statement = $db->prepare($sql);
$statement->bindParam(':username', $username);
$statement->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
$statement->bindParam(':id', $id);
$statement->execute();

generate_logs('Update Staff', $username.'| Staff was updated');
header('Location: ../staff.php?type=success&message=Staff updated successfully!');
exit();

?>