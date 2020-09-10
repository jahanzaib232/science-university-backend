<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){
    $_SESSION['message'] = "Record has been saved successfully";
    $_SESSION['msg_type'] = "success";
    $news_category = $_POST['inputNewsCategory'];
 
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO news_category (category_name, db_science_university_users_id) VALUES (?, ?)");
    $runQuery = $sql->execute([$news_category, $userID]);
    if($runQuery){     
        header('Location: ../../newsCategory.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../newsCategory.php');
    }
} else {
    header('Location: ../../newsCategory.php');
}

?>