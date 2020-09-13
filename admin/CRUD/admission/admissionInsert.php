<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){
    $_SESSION['message'] = "Record has been saved successfully";
    $_SESSION['msg_type'] = "success";
    
    $admission_name = $_POST['inputAdmissionTitle'];
    $admission_value = $_POST["inputAdmissionButtonText"]; 
    $admission_link = $_POST['inputAdmissionButtonLink'];
    $is_active = $_POST['inputAdmissionActive'];
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO db_science_university_admission (admission_text, admission_button, button_link, is_active, db_science_university_users_id) VALUES (?, ?, ?, ?, ?)");
    $sql->execute([$admission_name, $admission_value, $admission_link, $is_active, $userID]);
    if($runQuery){     
        header('Location: ../../admission.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../admission.php');
    }
} else {
    header('Location: ../../admission.php');
}

?>