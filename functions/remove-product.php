<?php
include_once 'connection.php';

try {
    $id = $_POST['data_id'];

    $sql = "SELECT * FROM expenditures WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $item_id = $results[0]['item_id'];
    $qty = $results[0]['qty'];
    
    $sql = "SELECT * FROM items WHERE id = :item_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $stock = $results[0]['stock'];
    
    $newStock = $stock + $qty;
    $sql = "UPDATE items SET stock = :new_stock WHERE id = :item_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':new_stock', $newStock);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    
    $sql = "DELETE FROM expenditures WHERE id = :id";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();

    generate_logs('Removing Expenditures', $id.'| Item was removed');
    header('Location: ../transaction.php?type=success&message=Item removed successfully!');
} catch (\Throwable $th) {
    generate_logs('Removing Expenditures', $th);
    header('Location: ../transaction.php?type=error&message=Something went wrong!');
}