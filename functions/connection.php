<?php
    $database = 'lms_db';
    $db = new PDO('mysql:host=localhost;dbname='.$database, 'root', '');

    if(!$db){
        die("Connection failed: " . $db->connect_error);
    }