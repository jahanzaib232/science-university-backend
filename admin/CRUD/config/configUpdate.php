<?php
require_once '../../database.php';

$id = $_POST['id_hidden'];

$sql = "SELECT config.config_name, config.config_value, config.is_active
FROM db_science_university_config config
WHERE config_id='$id'";

$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();
// var_dump($resultCol);
$config_name = $_POST['inputConfigNameEdit'];
$config_value = $_FILES["inputConfigValueEdit"]["name"]; 
$is_active = $_POST['inputConfigActiveEdit'];

$updateSQL = "UPDATE db_science_university_config 
SET config_name=?, config_value=?, is_active=?
WHERE config_id='$id'";
$result = $conn->prepare($updateSQL);
$runQuery = $result->execute([$config_name, $config_value, $is_active]);
if($runQuery){
    header('Location: ../../config.php');
} else {
    echo 'failed to update';
    header('Location: ../../config.php');
}
?>