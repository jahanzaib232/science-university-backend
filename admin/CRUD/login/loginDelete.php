<?php
session_start();

require_once '../../database.php';

if(isset($_GET['delete'])){ 
    $id = $_GET['delete'];
    $_SESSION['message'] = "Record has been deleted successfully";
    $_SESSION['msg_type'] = "danger";

    #1
    $sqlAdmission = $conn->prepare("DELETE FROM db_science_university_admission WHERE db_science_university_users_id=?");
    $result = $sqlAdmission->execute([$id]);
    #2
    $sqlConfig = $conn->prepare("DELETE FROM db_science_university_config WHERE db_science_university_users_id=?");
    $result = $sqlConfig->execute([$id]);
    #3
    $sqlCourses = $conn->prepare("DELETE FROM db_science_university_courses WHERE db_science_university_users_id=?");
    $result = $sqlCourses->execute([$id]);
    #4
    $sqlEvents = $conn->prepare("DELETE FROM db_science_university_events WHERE db_science_university_users_id=?");
    $result = $sqlEvents->execute([$id]);
    #5
    $sqlFooter = $conn->prepare("DELETE FROM db_science_university_footer WHERE db_science_university_users_id=?");
    $result = $sqlFooter->execute([$id]);
    #6
    $sqlHeader = $conn->prepare("DELETE FROM db_science_university_header WHERE db_science_university_users_id=?");
    $result = $sqlHeader->execute([$id]);
    #7
    $sqlMenu = $conn->prepare("DELETE FROM db_science_university_menu WHERE db_science_university_users_id=?");
    $result = $sqlMenu->execute([$id]);
    #8
    $sqlNavbar = $conn->prepare("DELETE FROM db_science_university_navbar WHERE db_science_university_users_id=?");
    $result = $sqlNavbar->execute([$id]);
    #9
    $sqlNews = $conn->prepare("DELETE FROM db_science_university_news WHERE db_science_university_user_id=?");
    $result = $sqlNews->execute([$id]);
    #10
    $sqlTicker = $conn->prepare("DELETE FROM db_science_university_ticker WHERE db_science_university_users_id=?");
    $result = $sqlTicker->execute([$id]);
    #11
    $sqlEventsCat = $conn->prepare("DELETE FROM events_category WHERE db_science_university_users_id=?");
    $result = $sqlEventsCat->execute([$id]);
    #12
    $sqlNewsCat = $conn->prepare("DELETE FROM news_category WHERE db_science_university_users_id=?");
    $result = $sqlNewsCat->execute([$id]);

    $sql = $conn->prepare("DELETE FROM db_science_university_users WHERE id=?");
    $result = $sql->execute([$id]);
    if($result){
        header('Location: ../../../adminprofile.php');
    } else {
        echo 'SQL statement DELETE was unsuccessful';
    }
} else {
    echo 'not working';
}

?>