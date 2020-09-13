<?php
session_start();
require_once '../../database.php';


$id = $_POST['id'];
$SQL = "SELECT nav_title, nav_link, is_active FROM db_science_university_navbar WHERE id='$id'";
$result = $conn->query($SQL);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$data['navTitle'] = $resultCol["nav_title"];
$data['navLink'] = $resultCol["nav_link"];
$data['isActive'] = $resultCol["is_active"];


echo json_encode($data);

?>