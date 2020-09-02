<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){

    $ticker_icon = $_FILES["inputIconImage"]["name"];
    $ticker_number = $_POST['inputTickerNumber'];
    $ticker_counter = $_POST['inputTickerCount'];
    $ticker_description = $_POST['inputTickerDescription'];

    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = "INSERT INTO db_science_university_ticker (icon_image, number_, 	inc_or_decr, description_, db_science_university_user_id) VALUES (?, ?, ?, ?, ?)";
    $result = $conn->prepare($sql);
    $runQuery = $result->execute([$ticker_icon, $ticker_number, $ticker_counter, $ticker_description, $userID]);
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