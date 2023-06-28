<?php
include_once 'functions/connection.php';

function customer_list (){
    global $db;
    $sql = 'SELECT * FROM customers ORDER BY fullname ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
    $fullname = $row['fullname'];
    ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $fullname; ?></option>
    <?php
    }
}

function items_list (){
    global $db;
    $sql = 'SELECT * FROM items ORDER BY name ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
    $name = $row['name'];
    ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $name; ?></option>
    <?php
    }
}


function price_list (){
    global $db;
    $sql = 'SELECT * FROM prices ORDER BY name ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
    $name = $row['name'];
    ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $name; ?> | ₱<?php echo $row['price']; ?></option>
    <?php
    }
}