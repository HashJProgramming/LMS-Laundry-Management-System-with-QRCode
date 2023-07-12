<?php
include_once 'functions/connection.php';

function get_monthly(){
    global $db;
    $sql = "SELECT SUM(total) AS total_earnings
            FROM transactions
            WHERE status = 4
            AND MONTH(created_at) = MONTH(CURRENT_TIMESTAMP)
            AND YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    foreach ($results as $row) {
        if ($row['total_earnings'] == null){
            echo "0";
        }
        else{
            echo $row['total_earnings'];
        }
    }
}

function get_yearly(){
    global $db;
    $sql = "SELECT YEAR(CURRENT_TIMESTAMP) AS year,
            SUM(total) AS total_earnings
            FROM transactions
            WHERE status = 4
            GROUP BY YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    if ($results){
    foreach ($results as $row) {
        echo $row['total_earnings'];
    }}
    else{
        echo "0";
    }
}


function get_pending(){
    global $db;
    $sql = "SELECT COUNT(*) AS total_pending
            FROM transactions
            WHERE status = 0";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    foreach ($results as $row) {
        echo $row['total_pending'];
    }
}

function get_processing(){
    global $db;
    $sql = "SELECT COUNT(*) AS total_processing
            FROM transactions
            WHERE status = 1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
   if($results){
    foreach ($results as $row) {
        echo $row['total_processing'];
    }}
    else{
        echo "0";
    }
}

function get_folding(){
    global $db;
    $sql = "SELECT COUNT(*) AS total_folding
            FROM transactions
            WHERE status = 2";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    if($results){
    foreach ($results as $row) {
        echo $row['total_folding'];
    }}
    else{
        echo "0";
    }
}

function get_ready(){
    global $db;
    $sql = "SELECT COUNT(*) AS total_ready
            FROM transactions
            WHERE status = 3";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    if($results){
    foreach ($results as $row) {
        echo $row['total_ready'];
    }}
    else{
        echo "0";
    }
}

function get_claimed(){
    global $db;
    $sql = "SELECT COUNT(*) AS total_claimed
            FROM transactions
            WHERE status = 4";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    if ($results){
    foreach ($results as $row) {
        echo $row['total_claimed'];
    }}
    else{
        echo "0";
    }
}

function get_customers(){
    global $db;
    $sql = "SELECT COUNT(*) AS total_customers
            FROM customers";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    if ($results){
    foreach ($results as $row) {
        echo $row['total_customers'];
    }}
    else{
        echo "0";
    }
}
