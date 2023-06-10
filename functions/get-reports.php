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
    WHERE  c.fullname LIKE :query AND t.previous IS NOT NULL AND t.current IS NOT NULL AND t.status = 'Proceed'";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':query' => $searchQuery));
    $results = $stmt->fetchAll();

} else {
    // Get all data from the students table
    $sql = "SELECT c.fullname as customer_name, t.id, t.consumption, t.previous, t.current, t.bill, t.created_at, t.status 
    FROM transactions t
    INNER JOIN customers c ON t.cust_id = c.id
    WHERE t.previous IS NOT NULL AND t.current IS NOT NULL AND t.status = 'Proceed'";
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
        <td ><?php echo $row['current'];?></td>
        <td class="text-center"><?php echo $row['created_at'];?></td>
        <td class="text-center"><?php echo $row['status'];?></td>
    </tr>
<?php
}