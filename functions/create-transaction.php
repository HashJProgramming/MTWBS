<?php
// connect to the database
$db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');

// get the values from the form
$id = $_POST['data_id'];
$reading = $_POST['reading'];

$sql = "SELECT * FROM customers WHERE id = :id AND status = 'Active'";
$statement = $db->prepare($sql);
$statement->bindParam(':id', $id);
$statement->execute();
if ($statement->fetchColumn() > 0) {

    $sql = "SELECT * FROM transactions WHERE cust_id = :id AND previous IS NOT NULL AND status = 'Process'";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();

    if ($statement->fetchColumn() > 0) {
        // get the previous reading
        $sql = "SELECT previous FROM transactions WHERE cust_id = :id AND previous IS NOT NULL AND status = 'Process'";
        $statement = $db->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $previous = $statement->fetchColumn();

        // get water consumption
        $consumption = $reading - $previous;
        $bill = $consumption * 36.86;

        $sql = "UPDATE transactions SET current = :reading, consumption = :consumption, bill = :bill, status = 'Pending' WHERE cust_id = :id AND previous IS NOT NULL AND status = 'Process'";
        $statement = $db->prepare($sql);
        $statement->bindParam(':reading', $reading);
        $statement->bindParam(':consumption', $consumption);
        $statement->bindParam(':bill', $bill);
        $statement->bindParam(':id', $id);
        $statement->execute();
        header('Location: ../administration.php#success');
        exit();
    }
    else {
        // get the last reading from transcations
        $sql = "SELECT current FROM transactions WHERE cust_id = :id AND current IS NOT NULL ORDER BY id DESC LIMIT 1";
        $statement = $db->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
            
        if ($statement->rowCount() > 0) {

            $previous = $statement->fetchColumn();

            // check if current reading is not less than previous reading
            if ($reading <= $previous) {
                header('Location: ../administration.php#error');
                exit();
            }

            $consumption = $reading - $previous;
            $bill = $consumption * 36.86;

            $sql = "INSERT INTO transactions (cust_id, previous, current, consumption, bill, status)
            VALUES (:id, :previous, :current, :consumption, :bill, 'Pending')";

            $statement = $db->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->bindParam(':previous',  $previous);
            $statement->bindParam(':current',  $reading);
            $statement->bindParam(':consumption',  $consumption);
            $statement->bindParam(':bill',  $bill);
            $statement->execute();
        }
        else {
            $sql = "INSERT INTO transactions (cust_id, previous, status)
            VALUES (:id, :previous, 'Process')";
            $statement = $db->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->bindParam(':previous', $reading);
            $statement->execute();
        }

        // redirect to the index page after adding the student
        header('Location: ../administration.php#success');
        exit();
    }
} else {
    header('Location: ../administration.php#error');
    exit();
}
