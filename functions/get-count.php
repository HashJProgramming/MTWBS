<?php

function get_customers_count(){
    $db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');
    // Get all data from the cars table
    $sql = 'SELECT COUNT(*) AS total FROM customers';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
        echo $row['total'];
    }
}

function get_pending_count(){
    $db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');
    // Get all data from the cars table
    $sql = 'SELECT COUNT(*) AS total FROM transactions WHERE status = "Pending"';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
        echo $row['total'];
    }
}

function get_proceed_count(){
    $db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');
    // Get all data from the cars table
    $sql = 'SELECT COUNT(*) AS total FROM transactions WHERE status = "Proceed"';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
        echo $row['total'];
    }
}

function get_sales(){
    $db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');
    // get total sales of the month from the transactions table
    $sql = 'SELECT SUM(bill) AS total FROM transactions WHERE status = "Proceed" AND MONTH(created_at) = MONTH(CURRENT_DATE())';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
        echo $row['total'];
    }
}