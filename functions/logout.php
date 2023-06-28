<?php
include_once 'connection.php';
session_start();
generate_logs('Logout', $_SESSION['username'].'User has logged out');
session_destroy();

header('Location: ../login.php');