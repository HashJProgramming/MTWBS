<?php

$db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');
$id = $_POST['data_id'];

$sql = "UPDATE transactions SET status = 'Proceed' WHERE id = :id AND status = 'Pending'";
$statement = $db->prepare($sql);
$statement->bindParam(':id', $id);
$statement->execute();

// get bill, consumption, current, previous from transactions and get customer name from customers where id = $id and status = 'Active' WHERE Transactions.status = 'Proceed'
$sql = "SELECT transactions.bill, transactions.consumption, transactions.current, transactions.previous, customers.fullname FROM transactions 
INNER JOIN customers ON transactions.cust_id = customers.id 
WHERE transactions.id = :id AND transactions.status = 'Proceed' ORDER BY transactions.id DESC LIMIT 1";

$statement = $db->prepare($sql);
$statement->bindParam(':id', $id);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

$bill = $result['bill'];
$consumption = $result['consumption'];
$current = $result['current'];
$previous = $result['previous'];
$fullname = $result['fullname'];


header('Location: ../success.php?total='.$bill.'&fullname='.$fullname.'&previous='.$previous.'&current='.$current.'&consumption='.$consumption.'');

