<?php
session_start();
require_once '../../database.php';


$id = $_POST['id'];
$SQL = "SELECT menu.title, menu.text, menu.icon, menu.url, menu.type_
FROM db_science_university_menu as menu 
WHERE menu_id='$id'";
$result = $conn->query($SQL);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$data['menuType'] = $resultCol["type_"];
$data['menuTitle'] = $resultCol["title"];
$data['menuText'] = $resultCol["text"];
$data['menuIcon'] = $resultCol["icon"];
$data['menuURL'] = $resultCol["url"];

echo json_encode($data);

?>