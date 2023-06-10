<?php

function get_total_bill($id){
    $db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');
    $sql = "SELECT SUM(bill) AS total_bill FROM transactions WHERE status = 'Pending' AND cust_id = $id";
     $stmt = $db->prepare($sql);
     $stmt->execute();
     $results = $stmt->fetchAll();
        foreach($results as $result){
           if($result['total_bill'] == NULL){
               echo "0";
            }else{
                echo number_format($result['total_bill'], 2, '.', ','); // as total sales 0.00    
            }
        }
}

function get_current($id){
    $db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');
    $sql = "SELECT current FROM transactions WHERE cust_id = :id AND current IS NOT NULL ORDER BY id DESC LIMIT 1";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
        
    if ($statement->rowCount() > 0) {

        $current = $statement->fetchColumn();
        echo $current;
    } else {
        echo "0";
    }
}

function get_previous($id){
    $db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');
    $sql = "SELECT previous FROM transactions WHERE cust_id = :id AND previous IS NOT NULL ORDER BY id DESC LIMIT 1";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
        
    if ($statement->rowCount() > 0) {

        $previous = $statement->fetchColumn();
        echo $previous;
    } else {
        echo "0";
    }
}

function get_customer_details($id){
    $db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');
    $sql = "SELECT * FROM customers WHERE id = :id";
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
    $results = $statement->fetchAll();
    foreach($results as $row){
        $birthDate = $row['birthdate'];
        $age =  date_diff(date_create($birthDate), date_create('today'))->y;

        // check if customer is active or not
        if($row['status'] == "Active"){
            $status = '<span class="badge bg-success">Active</span>';
        }else{
            $status = '<span class="badge bg-danger">Disconnected</span>';
        }
        ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"><span> <?php echo $row['fullname']; ?> </span></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"><span> <?php echo $row['phone']; ?> </span></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Birthdate</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"><span> <?php echo $row['birthdate']; ?> </span></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Age</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"><span> <?php echo $age; ?> </span></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"><span> <?php echo $row['address']; ?> </span></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <?php echo $status;?> 
                    </div>
                </div>
                <hr>
            </div>
        <?php
    }

}