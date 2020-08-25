<?php

require '../database.php';

if(isset($_POST['submitBtn'])){

    $navTitle = $_POST['inputNavTitle'];
    $navLink = $_POST['inputNavLink'];
    $admin = 1;

    $sql = "INSERT INTO db_science_university_navbar (nav_title, nav_link, db_science_university_users_id) VALUES ('$navTitle', '$navLink', '$admin')";
    $runQuery = mysqli_query($con, $sql);
    if($runQuery){     
        
        header('Location: ../navbar.php');
    } else {
        echo 'Insert didnt work';
    }
}

?>