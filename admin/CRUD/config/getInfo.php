<?php
session_start();
require_once '../../database.php';


$id = $_POST['id'];
$SQL = "SELECT config.config_id, config.config_name, config.config_value, config.is_active
FROM db_science_university_config as config
WHERE config_id='$id'";
$result = $conn->query($SQL);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$data['configName'] = $resultCol["config_name"];
$data['configValue'] = $resultCol["config_value"];
$data['configActive'] = $resultCol["is_active"];


echo json_encode($data);

?>