<?php
session_start();
require_once '../../database.php';


$id = $_POST['id'];
$SQL = "SELECT footer.parent_title, footer.item_list, footer.item_link, footer.item_icon, footer.image_, footer.is_active 
FROM db_science_university_footer footer 
WHERE footer_id='$id'";
$result = $conn->query($SQL);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$data['parentTitle'] = $resultCol["parent_title"];
$data['itemList'] = $resultCol["item_list"];
$data['itemIcon'] = $resultCol["item_icon"];
$data['itemLink'] = $resultCol["item_link"];
$data['image'] = $resultCol["image_"];
$data['isActive'] = $resultCol["is_active"];


echo json_encode($data);

?>