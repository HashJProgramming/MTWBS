<?php
// Connect to the database
$db = new PDO('mysql:host=localhost;dbname=mtwbs', 'root', '');

$sql = 'SELECT * FROM customers ORDER BY fullname ASC';
$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();
$select = 'selected=""';
foreach ($results as $row) {
?>
    <option value="<?php echo $row['id'];?>" <?php echo $select ?>><?php echo $row['fullname'];?></option>
<?php
$select = '';
}
