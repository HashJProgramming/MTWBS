<?php
// Connect to the database
$db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');

if (isset($_POST['search'])) {
    // Prepare search query
    $searchQuery = '%' . $_POST['search'] . '%';
    // Execute search query
    $sql = 'SELECT * FROM customers WHERE fullname LIKE :query ORDER BY fullname ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':query' => $searchQuery));
    $results = $stmt->fetchAll();
} else {
    // Get all data from the students table
    $sql = 'SELECT * FROM customers ORDER BY fullname ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
}

foreach ($results as $row) {
    // get age by birthdate
    $birthDate = $row['birthdate'];
    $age =  date_diff(date_create($birthDate), date_create('today'))->y;
?>
    <tr>
        <td class="text-truncate" style="max-width: 200px;"><?php echo $row['fullname']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $birthDate; ?></td>
        <td><?php echo $age; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td class="text-center">

            <a class="px-2" role="button" href="customer.php?id=<?php echo $row['id']?>&fullname=<?php echo $row['fullname']?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-eye-fill fs-5 text-primary">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"></path>
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"></path>
                </svg></a>

            <a class="px-2" role="button" href="#" data-bs-target="#update-customer" data-bs-toggle="modal" data-id="<?php echo $row['id']?>" data-fullname="<?php echo $row['fullname']?>" data-address="<?php echo $row['address']?>" data-phone="<?php echo $row['phone']?>" data-birthdate="<?php echo $row['birthdate']?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-pencil-square fs-5 text-success">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                </svg></a>

            <a class="px-2" role="button" href="#" data-bs-target="#remove" data-bs-toggle="modal" data-id="<?php echo $row['id']?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-trash fs-5 text-danger">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                </svg></a>
        </td>
    </tr>
        
<?php
}
