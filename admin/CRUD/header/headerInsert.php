<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){
    $_SESSION['message'] = "Record has been saved successfully";
    $_SESSION['msg_type'] = "success";

    $header_title = $_POST['inputHeaderTitle'];
    $header_image = $_FILES["inputHeaderImage"]["name"]; 
    $header_text = $_POST['inputHeaderText'];
    $header_order = $_POST['inputHeaderOrder'];
    $header_active = $_POST['inputHeaderActive'];
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO db_science_university_header (image_path_file, header_title, header_text, order_, is_active, db_science_university_users_id) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->execute([$header_image, $header_title, $header_text, $header_order, $header_active, $userID]);
    if($runQuery){     
        header('Location: ../../header.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../header.php');
    }
} else {
    header('Location: ../../header.php');
}

?>