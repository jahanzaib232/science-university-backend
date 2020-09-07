<?php
require_once '../../database.php';

$data = stripslashes($_POST['data']);
echo $data; 

$sql = "SELECT * FROM db_science_university_navbar nav WHERE id='".$_POST["data"]."'";
$sqlResult = $conn->query($sql);
$result = $sqlResult->execute();
?>