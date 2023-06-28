<?php
include_once 'setup.php';
$database = 'lms_db';
$db = new PDO('mysql:host=localhost;dbname=' . $database, 'root', '');

if (!$db) {
    die("Connection failed: " . $db->connect_error);
}

function generate_logs($logs, $type)
{
    global $db;
    $sql = "INSERT INTO logs (logs, type) VALUES (:logs, :type)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':logs', $logs);
    $stmt->bindParam(':type', $type);
    $stmt->execute();
}
