<?php
session_start();
require_once '../../database.php';

if(isset($_POST['submitBtn'])){
    $_SESSION['message'] = "Record has been saved successfully";
    $_SESSION['msg_type'] = "success";

    $news_title = $_POST['inputNewsTitle'];
    $news_link = $_POST['inputNewsLink'];
    $news_category = $_POST['newsCategories'];
    $news_description = $_POST['inputNewsDescription'];
    $news_date = $_POST['inputNewsDate'];
    $newsActive = $_POST['inputNewsActive'];
 
    $loggedInUser = $conn->prepare("SELECT user.id FROM db_science_university_users user WHERE email=?");
    $loggedInUser->execute([$_SESSION['email']]);
    $userID = $loggedInUser->fetchColumn();


   
    $newsCategory = $conn->prepare("SELECT news_cat.category_id FROM news_category as news_cat WHERE news_cat.category_id=?");
    $newsCategory->execute([$news_category]);
    $newsCategoryId = $newsCategory->fetchColumn();

    $sql = "INSERT INTO db_science_university_news (news_title, news_link, news_description, news_date, news_category_category_id, is_active, db_science_university_user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $result = $conn->prepare($sql);
    $runQuery = $result->execute([$news_title, $news_link, $news_description, $news_date, $newsCategoryId, $newsActive, $userID]);
    if($runQuery){     
        header('Location: ../../news.php');
    } else {
        echo 'Insert didnt work';
        header('Location: ../../news.php');
    }
} else {
    header('Location: ../../news.php');
}

?>