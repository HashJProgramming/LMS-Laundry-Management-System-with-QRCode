<?php
include_once 'connection.php';

try {
    $id = $_POST['data_id'];
    $sql = "DELETE FROM prices WHERE id = :id";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();

    generate_logs('Removing Price', $id.'| Price was removed');
    header('Location: ../profile.php?type=success&message=Price removed successfully!');
} catch (\Throwable $th) {
    generate_logs('Removing Price', $th);
    header('Location: ../profile.php?type=error&message=Something went wrong!');
}