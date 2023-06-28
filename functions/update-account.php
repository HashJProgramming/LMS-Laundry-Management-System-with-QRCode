<?php
include_once 'connection.php';

$username = $_POST['username'];
$password = $_POST['current'];
$newpassword = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ? AND level = '0'";
$stmt = $db->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {

    $sql = "UPDATE users SET
    username = :username,
    password = :password
        WHERE level = 0";
        
    $statement = $db->prepare($sql);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', password_hash($newpassword, PASSWORD_DEFAULT));
    $statement->execute();

    generate_logs('Update Account', $username.'| Account was updated');
    header('Location: ../profile.php?type=success&message=Account updated successfully!');
    exit();

} else {

    header('Location: ../profile.php?type=error&message=Incorrect Password!');
    exit();
}



?>