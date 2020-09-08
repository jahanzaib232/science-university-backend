<?php
require_once '../../database.php';

$id = $_POST['id_hidden'];

$sql = "SELECT ticker.icon_image, ticker.number_, ticker.inc_or_decr, ticker.description_
FROM db_science_university_ticker ticker
WHERE ticker_id='$id'";

$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();
// var_dump($resultCol);
$ticker_icon = $_FILES["inputIconImageEdit"]["name"];
$ticker_number = $_POST['inputTickerNumberEdit'];
$ticker_counter = $_POST['inputTickerCountEdit'];
$ticker_description = $_POST['inputTickerDescriptionEdit'];

$updateSQL = "UPDATE db_science_university_ticker 
SET icon_image=?, number_=?, inc_or_decr=?, description_=?
WHERE ticker_id='$id'";
$result = $conn->prepare($updateSQL);
$runQuery = $result->execute([$ticker_icon, $ticker_number, $ticker_counter, $ticker_description]);
if($runQuery){
    header('Location: ../../ticker.php');
} else {
    echo 'failed to update';
    header('Location: ../../ticker.php');
}
?>