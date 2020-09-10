<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){
    $_SESSION['message'] = "Record has been saved successfully";
    $_SESSION['msg_type'] = "success";
    
    $config_name = $_POST['inputConfigName'];
    $config_value = $_FILES["inputConfigValue"]["name"]; 
    $is_active = $_POST['inputConfigActive'];
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO db_science_university_config (config_name, config_value, is_active, db_science_university_users_id) VALUES (?, ?, ?, ?)");
    $sql->execute([$config_name, $config_value, $is_active, $userID]);
    if($runQuery){     
        header('Location: ../../config.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../config.php');
    }
} else {
    header('Location: ../../config.php');
}

?>