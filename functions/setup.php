<?php
    $database = 'lms_db';
    $db = new PDO('mysql:host=localhost', 'root', '');
    $query = "CREATE DATABASE IF NOT EXISTS $database";

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($query);
        $db->exec("USE $database");

        $db->exec("
            CREATE TABLE IF NOT EXISTS users (
              id INT PRIMARY KEY AUTO_INCREMENT,
              username VARCHAR(255),
              password VARCHAR(255),
              level VARCHAR(255),
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");

        $db->exec("
            CREATE TABLE IF NOT EXISTS customers (
              id INT PRIMARY KEY AUTO_INCREMENT,
              fullname VARCHAR(255),
              address VARCHAR(255),
              contact VARCHAR(255),
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");

        $db->exec("
            CREATE TABLE IF NOT EXISTS transactions (
              id INT PRIMARY KEY AUTO_INCREMENT,
              user_id INT,
              customer_id INT,
              kilo DOUBLE,
              type VARCHAR(255),
              status VARCHAR(255),
              FOREIGN KEY (user_id) REFERENCES users(id),
              FOREIGN KEY (customer_id) REFERENCES customers(id)
            )
        ");

        $db->exec("
            CREATE TABLE IF NOT EXISTS items (
              id INT PRIMARY KEY AUTO_INCREMENT,
              name VARCHAR(255),
              price DOUBLE,
              stock INT,
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");

        $db->exec("
            CREATE TABLE IF NOT EXISTS expenditures (
              id INT PRIMARY KEY AUTO_INCREMENT,
              user_id INT,
              item_id INT,
              transaction_id INT,
              qty INT,
              total DOUBLE,
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
              FOREIGN KEY (user_id) REFERENCES users(id),
              FOREIGN KEY (item_id) REFERENCES items(id),
              FOREIGN KEY (transaction_id) REFERENCES transactions(id)
            )
        ");

        $db->beginTransaction();

        // Check if admin user already exists
        $stmt = $db->prepare("SELECT COUNT(*) FROM `users` WHERE `username` = 'admin'");
        $stmt->execute();
        $userExists = $stmt->fetchColumn();
        
        if (!$userExists) {
            $stmt = $db->prepare("INSERT INTO `users` (`username`, `password`, `level`) VALUES (:username, :password, :level)");
            $stmt->bindValue(':username', 'admin');
            $stmt->bindValue(':password', '$2y$10$WgL2d2fzi6IiGiTfXvdBluTLlMroU8zBtIcRut7SzOB6j9i/LbA4K');
            $stmt->bindValue(':level', 0);
            $stmt->execute();
        }
        
        $db->commit();

    } catch(PDOException $e) {
        die("Error creating database: " . $e->getMessage());
    }
    
    $db = null;
?>