<?php
include_once 'connection.php';

try {
    $id = $_POST['data_id'];
    $sql = "DELETE FROM customers WHERE id = :id";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();

    generate_logs('Removing Customer', $id.'| Customer was removed');
    header('Location: ../customer.php?type=success&message=Customer removed successfully!');
} catch (\Throwable $th) {
    generate_logs('Removing Customer', $th);
    header('Location: ../customer.php?type=error&message=Something went wrong!');
}