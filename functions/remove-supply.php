<?php
include_once 'connection.php';

try {
    $id = $_POST['data_id'];
    $sql = "DELETE FROM items WHERE id = :id";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();

    header('Location: ../supply.php?type=success&message=Item removed successfully!');
} catch (\Throwable $th) {
    generate_logs($th, 'Removing Supply');
    header('Location: ../supply.php?type=error&message=Something went wrong!');
}