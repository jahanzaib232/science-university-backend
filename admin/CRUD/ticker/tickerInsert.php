<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){
    $_SESSION['message'] = "Record has been saved successfully";
    $_SESSION['msg_type'] = "success";

    $ticker_icon = $_FILES["inputIconImage"]["name"];
    $ticker_number = $_POST['inputTickerNumber'];
    $ticker_counter = $_POST['inputTickerCount'];
    $ticker_description = $_POST['inputTickerDescription'];
    $data_target = $_POST['inputDataTarget'];
    $ticker_character = $_POST['inputTickerCharacter'];
    $ticker_character_before_num = $_POST['inputCharacterBeforeNum'];

    // echo $ticker_character_before_num;
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = "INSERT INTO db_science_university_ticker (icon_image, character_, character_before_number, number_, data_target, inc_or_decr, description_, db_science_university_users_id) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $result = $conn->prepare($sql);
    $runQuery = $result->execute([$ticker_icon, $ticker_character, $ticker_character_before_num, $ticker_number, $data_target, $ticker_counter, $ticker_description, $userID]);
    if($runQuery){     
        header('Location: ../../ticker.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../ticker.php');
    }
} else {
    header('Location: ../../ticker.php');
}

?>