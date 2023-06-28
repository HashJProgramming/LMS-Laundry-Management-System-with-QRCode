<?php
include_once 'connection.php';


$username = $_POST['username'];
$password = $_POST['password'];
$repassword = $_POST['re-password'];

if ($password != $repassword) {
    header('Location: ../staff.php?type=error&message=The two passwords do not match');
    exit;
}

$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header('Location: ../staff.php?type=error&message=The username is already taken');
    exit;
}

$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password, level) VALUES (:username, :password, 1)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

generate_logs('Adding Staff', $username.'| New Staff was added');
header('Location: ../staff.php?type=success&message=The user was added successfully');

?>