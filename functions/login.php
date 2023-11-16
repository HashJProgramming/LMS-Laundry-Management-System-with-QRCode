<?php
include_once 'connection.php';

// Get the form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the user exists
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {

    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['level'] = $user['level'];
    $_SESSION['id'] = $user['id'];
    if (isset($_POST['remember'])) {
        setcookie('username', $username, time() + (86400 * 30), "/");
        setcookie('password', $password, time() + (86400 * 30), "/");
    } else {
        setcookie('username', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
    }
    generate_logs('Login', $username.'| Logged in');
    header('location: ../index.php');
} else {
    // Show an error message
    header('location: ../login.php?type=error&message=Wrong username or password');
}
