<?php
session_start();
require_once '../../database.php';
if(isset($_POST['updateBtn'])){

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";

    $id = $_POST['id_hidden'];

    $sql = "SELECT ticker.icon_image, ticker.number_, ticker.inc_or_decr, ticker.character_, ticker.data_target, ticker.description_
    FROM db_science_university_ticker ticker
    WHERE ticker_id='$id'";

    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $resultCol = $result->fetch();
  
    $ticker_icon = $_FILES["inputIconImageEdit"]["name"];
    $ticker_number = $_POST['inputTickerNumberEdit'];
    $ticker_counter = $_POST['inputTickerCountEdit'];
    $ticker_description = $_POST['inputTickerDescriptionEdit'];
    $data_target = $_POST['inputDataTargetEdit'];
    $ticker_character = $_POST['inputTickerCharacterEdit'];

    $updateSQL = "UPDATE db_science_university_ticker 
    SET icon_image=?, character_=?, number_=?, data_target=?, inc_or_decr=?, description_=?
    WHERE ticker_id='$id'";
    $result = $conn->prepare($updateSQL);
    $runQuery = $result->execute([$ticker_icon, $ticker_character, $ticker_number, $data_target, $ticker_counter, $ticker_description]);
    if($runQuery){
        header('Location: ../../ticker.php');
    } else {
        echo 'failed to update';
        header('Location: ../../ticker.php');
    }
}
?>