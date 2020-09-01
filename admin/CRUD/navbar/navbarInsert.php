<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){

    $navTitle = $_POST['inputNavTitle'];
    $navLink = $_POST['inputNavLink'];

    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = $conn->prepare("INSERT INTO db_science_university_navbar (nav_title, nav_link, db_science_university_users_id) VALUES (?, ?, ?)");
    $runQuery = $sql->execute([$navTitle, $navLink, $userID]);
    if($runQuery){     
        header('Location: ../../navbarPages.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../navbarPages.php');
    }
} else {
    header('Location: ../../navbarPages.php');
}

?>