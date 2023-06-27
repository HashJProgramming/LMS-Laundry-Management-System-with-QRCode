<?php
include_once 'connection.php';


$username = $_POST['username'];
$password = $_POST['password'];
$repassword = $_POST['re-password'];

if ($password != $repassword) {
  echo "The passwords do not match.";
  exit;
}

$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();

if ($stmt->rowCount() > 0) {
  echo "The username already exists.";
  exit;
}

$password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user into the database
$sql = "INSERT INTO users (username, password, level) VALUES (:username, :password, 1)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

// Redirect the user to the login page
header('Location: ../index.php');

?>