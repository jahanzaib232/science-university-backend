<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){

    $menuText = $_POST['inputMenuText'];
    $menuIcon = $_FILES["inputMenuIcon"]["name"]; 
    $menuUrl = $_POST['inputMenuUrl'];
    $menuParent = $_POST['inputMenuParent'];
    $menuType = $_POST['inputMenuType'];
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO db_science_university_menu (text, icon, url, parent, type, db_science_university_users_id) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->execute([$menuText, $menuIcon, $menuUrl, $menuParent, $menuType, $userID]);
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