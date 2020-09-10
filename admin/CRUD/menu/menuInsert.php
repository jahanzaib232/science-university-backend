<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){
    $_SESSION['message'] = "Record has been saved successfully";
    $_SESSION['msg_type'] = "success";

    $menuTitle = $_POST['inputMenuTitle'];
    $menuText = $_POST['inputMenuText'];
    $menuIcon = $_FILES["inputMenuIcon"]["name"]; 
    $menuUrl = $_POST['inputMenuUrl'];
    $menuType = $_POST['inputMenuType'];
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO db_science_university_menu (title, text, icon, url, type_, db_science_university_users_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sql->execute([$menuTitle, $menuText, $menuIcon, $menuUrl, $menuType, $userID]);
    if($runQuery){     
        header('Location: ../../menu.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../menu.php');
    }
} else {
    header('Location: ../../menu.php');
}

?>