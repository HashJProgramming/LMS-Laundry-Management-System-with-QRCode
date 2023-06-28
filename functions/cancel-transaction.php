<?php
include_once 'connection.php';

try {
    $id = $_POST['data_id'];

    $sql = "SELECT * FROM transactions WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $results = $stmt->fetchAll();

    if (count($results) <= 0) {
        header('Location: ../transaction.php?type=error&message=You have no transaction yet!');
        exit();
    }

    $sql = 'SELECT * FROM expenditures WHERE transaction_id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $_POST['data_id']);
    $stmt->execute();
    $results = $stmt->fetchAll();

    if (count($results) > 0) {
      
        foreach ($results as $row) {
            $item_id = $row['item_id'];
            $qty = $row['qty'];
            
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
        }

        $sql = "DELETE FROM expenditures WHERE transaction_id = :id";
        $statement = $db->prepare($sql);
        $statement->bindParam(':id', $_POST['data_id']);
        $statement->execute();
    } 

    $sql = "DELETE FROM transactions WHERE id = :id";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();

    generate_logs('Transaction Cancel', 'Transaction '.$id.' cancelled successfully!');
    header('Location: ../transaction.php?type=success&message=Transaction cancelled successfully!');

   

} catch (\Throwable $th) {
    generate_logs('Transaction Cancel', $th);
    header('Location: ../transaction.php?type=error&message=Something went wrong!');
}