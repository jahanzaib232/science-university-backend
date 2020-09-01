<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){
    $eventsCategory = $_POST['inputEventsCategory'];

    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO events_category (category_name, db_science_university_users_id) VALUES (?, ?)");
    $sql->execute([$eventsCategory, $userID]);
    if($runQuery){     
        header('Location: ../../eventsCategory.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../eventsCategory.php');
    }
} else {
    header('Location: ../../eventsCategory.php');
}

?>