<?php
include_once 'setup.php';
$database = 'lms_db';
$db = new PDO('mysql:host=localhost;dbname=' . $database, 'root', '');

if (!$db) {
    die("Connection failed: " . $db->connect_error);
}

function generate_logs($type, $logs)
{
    session_start();
    global $db;
    $sql = "INSERT INTO logs (user_id, logs, type) VALUES (:user_id, :logs, :type)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $_SESSION['id']);
    $stmt->bindParam(':logs', $logs);
    $stmt->bindParam(':type', $type);
    $stmt->execute();
}
