SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `lms_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `lms_db`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE `expenditures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE `laundry` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `kilo` double DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `logs` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10, 2) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total` decimal(10, 2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
  `users` (
    `id`,
    `username`,
    `password`,
    `level`,
    `created_at`
  )
VALUES
  (
    1,
    'admin',
    '$2y$10$WgL2d2fzi6IiGiTfXvdBluTLlMroU8zBtIcRut7SzOB6j9i/LbA4K',
    '0',
    '2023-11-21 04:55:20'
  );

ALTER TABLE
  `customers`
ADD
  PRIMARY KEY (`id`);

ALTER TABLE
  `expenditures`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `user_id` (`user_id`),
ADD
  KEY `item_id` (`item_id`),
ADD
  KEY `transaction_id` (`transaction_id`);

ALTER TABLE
  `items`
ADD
  PRIMARY KEY (`id`);

ALTER TABLE
  `laundry`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `transaction_id` (`transaction_id`),
ADD
  KEY `type` (`type`);

ALTER TABLE
  `logs`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `user_id` (`user_id`);

ALTER TABLE
  `prices`
ADD
  PRIMARY KEY (`id`);

ALTER TABLE
  `transactions`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `user_id` (`user_id`),
ADD
  KEY `customer_id` (`customer_id`);

ALTER TABLE
  `users`
ADD
  PRIMARY KEY (`id`);

ALTER TABLE
  `customers`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
  `expenditures`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
  `items`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
  `laundry`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
  `logs`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
  `prices`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
  `transactions`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE
  `users`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;

ALTER TABLE
  `expenditures`
ADD
  CONSTRAINT `expenditures_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
ADD
  CONSTRAINT `expenditures_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
ADD
  CONSTRAINT `expenditures_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

ALTER TABLE
  `laundry`
ADD
  CONSTRAINT `laundry_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
ADD
  CONSTRAINT `laundry_ibfk_2` FOREIGN KEY (`type`) REFERENCES `prices` (`id`) ON DELETE CASCADE;

ALTER TABLE
  `logs`
ADD
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

ALTER TABLE
  `transactions`
ADD
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
ADD
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

COMMIT;