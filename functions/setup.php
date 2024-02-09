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
            CREATE TABLE IF NOT EXISTS prices (
              id INT PRIMARY KEY AUTO_INCREMENT,
              name VARCHAR(255),
              unit VARCHAR(255),
              price DECIMAL(10,2),
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
              total DECIMAL(10,2),
              amount DECIMAL(10,2),
              status VARCHAR(255),
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
              FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
              FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
            )
        ");

        $db->exec("
          CREATE TABLE IF NOT EXISTS laundry (
            id INT PRIMARY KEY AUTO_INCREMENT,
            transaction_id INT,
            kilo DOUBLE,
            type INT,
            status VARCHAR(255),
            date0 DATETIME,
            date1 DATETIME,
            date2 DATETIME,
            date3 DATETIME,
            date4 DATETIME,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (transaction_id) REFERENCES transactions(id) ON DELETE CASCADE,
            FOREIGN KEY (type) REFERENCES prices(id) ON DELETE CASCADE
          )
      ");

        $db->exec("
            CREATE TABLE IF NOT EXISTS items (
              id INT PRIMARY KEY AUTO_INCREMENT,
              name VARCHAR(255),
              unit VARCHAR(255),
              stock INT,
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");

        $db->exec("
          CREATE TABLE IF NOT EXISTS logs (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id int,
            logs TEXT,
            type TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )
        ");

        $db->exec("
            CREATE TABLE IF NOT EXISTS expenditures (
              id INT PRIMARY KEY AUTO_INCREMENT,
              user_id INT,
              item_id INT,
              transaction_id INT,
              qty INT,
              created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
              FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
              FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE CASCADE,
              FOREIGN KEY (transaction_id) REFERENCES transactions(id) ON DELETE CASCADE
            )
        ");

        $db->beginTransaction();

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
?>