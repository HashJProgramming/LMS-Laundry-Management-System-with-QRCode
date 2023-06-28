<?php
include_once 'connection.php';

try {
    $id = $_POST['data_id'];
    $sql = "DELETE FROM users WHERE id = :id";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
    header('Location: ../staff.php?type=success&message=Staff removed successfully!');
} catch (\Throwable $th) {
    generate_logs($th, 'Removing Staff');
    header('Location: ../staff.php?type=error&message=Something went wrong!');
}