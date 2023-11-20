<?php
include_once 'connection.php';

try {
    $id = $_POST['data_id'];

    $sql = "DELETE FROM laundry WHERE id = :id";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();

    generate_logs('Removing Laundry', $id.'| Laundry was removed');
    header('Location: ../transaction.php?type=success&message=Laundry removed successfully!');
} catch (\Throwable $th) {
    generate_logs('Removing Laundry', $th);
    header('Location: ../transaction.php?type=error&message=Something went wrong!');
}