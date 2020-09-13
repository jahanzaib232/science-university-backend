<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){
    $_SESSION['message'] = "Record has been saved successfully";
    $_SESSION['msg_type'] = "success";

    $event_title = $_POST['inputEventTitle'];
    $event_category = $_POST['eventsCategories'];
    $event_description = $_POST['inputEventDescription'];
    $event_image = $_FILES["inputEventIcon"]["name"];
    $event_date = $_POST['inputEventDate'];
    $event_start_time = $_POST['inputEventStartTime'];
    $event_end_time = $_POST['inputEventEndTime'];
    $event_location = $_POST['inputEventLocation'];
    $event_active = $_POST['inputEventsActive'];
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();



    $eventsCategory = $conn->prepare("SELECT event_cat.category_id FROM events_category as event_cat WHERE event_cat.category_id=?");
    $eventsCategory->execute([$event_category]);
    $eventsCategoryId = $eventsCategory->fetchColumn();

    $sql = "INSERT INTO db_science_university_events (event_title, event_description, event_image, event_date, event_start_time, event_end_time, event_location, event_category_category_id, is_active, db_science_university_users_id) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = $conn->prepare($sql);
    $runQuery = $result->execute([$event_title, $event_description, $event_image, $event_date, $event_start_time, $event_end_time, $event_location, $eventsCategoryId, $event_active, $userID]);
    if($runQuery){     
        header('Location: ../../events.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../events.php');
    }
} else {
    header('Location: ../../events.php');
}

?>