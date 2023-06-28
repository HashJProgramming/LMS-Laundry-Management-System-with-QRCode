<?php
include_once 'functions/connection.php';

$sql = 'SELECT * FROM customers ORDER BY fullname ASC';
$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();

foreach ($results as $row) {
$fullname = $row['fullname'];
?>
    <option value="<?php echo $row['id']; ?>"><?php echo $fullname; ?></option>
<?php
}
