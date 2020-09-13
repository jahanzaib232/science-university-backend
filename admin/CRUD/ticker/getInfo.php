<?php
session_start();
require_once '../../database.php';


$id = $_POST['id'];
$SQL = "SELECT ticker.icon_image, ticker.number_, ticker.character_, ticker.character_before_number, ticker.data_target, ticker.inc_or_decr, ticker.description_
FROM db_science_university_ticker as ticker 
WHERE ticker_id='$id'";
$result = $conn->query($SQL);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$data['tickerImage'] = $resultCol["icon_image"];
$data['tickerNumber'] = $resultCol["number_"];
$data['tickerCharacter'] = $resultCol["character_"];
$data['tickerCharBeforeNum'] = $resultCol["character_before_number"];
$data['tickerTarget'] = $resultCol["data_target"];
$data['tickerCount'] = $resultCol["inc_or_decr"];
$data['tickerDescription'] = $resultCol["description_"];

echo json_encode($data);

?>