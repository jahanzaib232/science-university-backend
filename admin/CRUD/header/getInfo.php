<?php
session_start();
require_once '../../database.php';


$id = $_POST['id'];
$SQL = "SELECT header.image_path_file, header.header_text, header.header_title, header.order_
FROM db_science_university_header as header WHERE header_id='$id'";
$result = $conn->query($SQL);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$data['headerImage'] = $resultCol["image_path_file"];
$data['headerText'] = $resultCol["header_text"];
$data['headerTitle'] = $resultCol["header_title"];
$data['headerOrder'] = $resultCol["order_"];

echo json_encode($data);

?>