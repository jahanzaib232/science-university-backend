<?php

require '../database.php';

if(isset($_POST['loginBtn'])){

    header('Location: ../adminprofile.php');

    // $email = $_POST['loginEmail'];
    // $password = $_POST['loginPassword'];

    // $sql = "INSERT INTO db_science_university_navbar (nav_title, nav_link, db_science_university_users_id) VALUES ('$navTitle', '$navLink', '$admin')";
    // $runQuery = mysqli_query($con, $sql);
    // if($runQuery){     
        
    //     header('Location: ../adminprofile.php');
    // } else {
    //     echo 'Insert didnt work';
    // }
}

?>