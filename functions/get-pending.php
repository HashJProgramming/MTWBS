<?php
// Connect to the database
$db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');

if (isset($_POST['search'])) {
    // Prepare search query
    $searchQuery = '%' . $_POST['search'] . '%';
    // Execute search query
    $sql = "SELECT c.fullname as customer_name, t.id, t.consumption, t.previous, t.current, t.bill, t.created_at, t.status 
    FROM transactions t
    INNER JOIN customers c ON t.cust_id = c.id
    WHERE  c.fullname LIKE :query AND t.previous IS NOT NULL AND t.current IS NOT NULL AND t.status = 'Pending'";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':query' => $searchQuery));
    $results = $stmt->fetchAll();

} else {
    // Get all data from the students table
    $sql = "SELECT c.fullname as customer_name, t.id, t.consumption, t.previous, t.current, t.bill, t.created_at, t.status 
    FROM transactions t
    INNER JOIN customers c ON t.cust_id = c.id
    WHERE t.previous IS NOT NULL AND t.current IS NOT NULL AND t.status = 'Pending';";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
}

foreach ($results as $row) {
?>
    
    <tr>
        <td class="text-truncate" style="max-width: 200px;"><?php echo $row['customer_name'];?></td>
        <td class="text-truncate" style="max-width: 200px;"><?php echo $row['consumption'];?></td>
        <td>$<?php echo $row['bill'];?></td>
        <td><?php echo $row['previous'];?></td>
        <td><?php echo $row['current'];?></td>
        <td class="text-center"><?php echo $row['created_at'];?></td>
        <td class="text-center"><?php echo $row['status'];?></td>
        <td class="text-center">

            <a class="px-2" type="button" data-bs-target="#proceed" data-bs-toggle="modal" data-id="<?php echo $row['id']?>">
            <svg class="bi bi-credit-card-2-front fs-5 text-primary" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"></path>
                <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"></path>
            </svg>
            </a>
            
            <a class="px-2" href="#" data-bs-target="#remove-transaction" data-bs-toggle="modal" data-id="<?php echo $row['id']?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-trash fs-5 text-danger">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                </svg>
            </a>
        </td>

    </tr>
<?php
}