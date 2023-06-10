<?php
// connect to the database
$db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');

// get the values from the form
$id = $_POST['data_id'];
$fullname = $_POST['fullname'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$birthdate = $_POST['birthdate']; 
$status = $_POST['status'];
// check if the student already exists
$sql = "SELECT * FROM customers WHERE fullname = :fullname";
$statement = $db->prepare($sql);
$statement->bindParam(':fullname', $fullname);
$statement->execute();

// if the car already exists, redirect to the index page
    if ($statement->fetchColumn() === 0) {
        header('Location: ../administration.php#error');
        exit();
    }
    // if the student does not already exist, proceed with adding them
    else {
        // prepare and execute the SQL query
        $sql = "UPDATE customers SET fullname = :fullname, address = :address, phone = :phone, birthdate = :birthdate, status = :status WHERE id = :id";
        $statement = $db->prepare($sql);
        $statement->bindParam(':fullname', $fullname);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':birthdate', $birthdate);
        $statement->bindParam(':status', $status);
        $statement->bindParam(':id', $id);
        $statement->execute();

        // redirect to the index page after adding the student
        header('Location: ../administration.php#success');
        exit();
    }
    