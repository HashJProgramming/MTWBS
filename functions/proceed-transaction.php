<?php

$db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');
$id = $_POST['data_id'];

$sql = "UPDATE transactions SET status = 'Proceed' WHERE id = :id AND status = 'Pending'";
$statement = $db->prepare($sql);
$statement->bindParam(':id', $id);
$statement->execute();

header('Location: ../administration.php#success');