<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){
    $_SESSION['message'] = "Record has been saved successfully";
    $_SESSION['msg_type'] = "success";

    $parentTitle = $_POST['inputParentTitle'];
    $itemList = $_POST['inputItemList'];
    $itemIcon = $_POST["inputItemIcon"]; 
    $itemLink = $_POST["inputItemLink"]; 
    $footerImage = $_FILES["inputFooterImage"]["name"]; 
    $footerActive = $_POST['inputFooterActive'];
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO db_science_university_footer (parent_title, item_list, item_link, item_icon, image_, is_active, db_science_university_users_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sql->execute([$parentTitle, $itemList, $itemLink, $itemIcon, $footerImage, $footerActive, $userID]);
    if($runQuery){     
        header('Location: ../../footer.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../footer.php');
    }
} else {
    header('Location: ../../footer.php');
}

?>