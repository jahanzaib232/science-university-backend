<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){

    $course_category = $_POST['inputCourseCategory'];
    $course_image = $_FILES["inputCourseImage"]["name"];

    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();

    $sql = "INSERT INTO db_science_university_courses (category_title, course_image, db_science_university_users_id) VALUES (?, ?, ?)";
    $result = $conn->prepare($sql);
    $runQuery = $result->execute([$course_category, $course_image, $userID]);
    if($runQuery){     
        header('Location: ../../courses.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../courses.php');
    }
} else {
    header('Location: ../../courses.php');
}

?>