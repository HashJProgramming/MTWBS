<?php

// Connect to the database
$db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');

// Get the form data
$id = $_POST['data_id'];

// Check if the user exists
$sql = "SELECT * FROM customers WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

if ($stmt->rowCount() === 0) {
  echo "The user does not exist.";
  exit;
}

// Check if the user exists
$sql = "SELECT * FROM transactions WHERE cust_id = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
  $sql = "DELETE FROM transactions WHERE cust_id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
}

// Remove the user from the database 
$sql = "DELETE FROM customers WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

// Redirect the user to the home page
header('Location: ../administration.php#success');

?>
