<?php
require_once '../adminprofile.php';

require_once '../database.php';

if(isset($_POST['submitBtn'])){

    $navTitle = $_POST['inputNavTitle'];
    $navLink = $_POST['inputNavLink'];
    $email = $_POST['inputEmail'];

    $loggedInUser = "SELECT user.id FROM db_science_university_users user WHERE email='$email'";

    $sql = "INSERT INTO db_science_university_navbar (nav_title, nav_link, db_science_university_users_id) VALUES ('$navTitle', '$navLink', '$loggedInUser')";
    $runQuery = mysqli_query($con, $sql);
    echo mysqli_error($runQuery);

    if($runQuery){     
        echo mysqli_error($con);
        // header('Location: ../navbar.php');
    } else {
        echo 'Insert didnt work';
        echo mysqli_error($con);

        // header('Location: ../navbar.php');

    }
    echo mysqli_error($con);

    // header('Location: ../navbar.php');
} else {
    echo mysqli_error($con);

    // header('Location: ../navbar.php');

}

?>