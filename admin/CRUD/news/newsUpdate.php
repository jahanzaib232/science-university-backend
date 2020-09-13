<?php
session_start();
require_once '../../database.php';
if(isset($_POST['updateBtn'])){

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";

    $id = $_POST['id_hidden'];

    $sql = "SELECT news_cat.category_name, news.news_title, news.news_link, news.news_description, news.news_date, news.news_category_category_id 
    FROM db_science_university_news news JOIN news_category news_cat 
    WHERE id='$id' AND news_cat.category_id = news.news_category_category_id";

    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $resultCol = $result->fetch();

    $news_title = $_POST['inputNewsTitleEdit'];
    $news_link = $_POST['inputNewsLinkEdit'];
    $news_category = $_POST['newsCategoriesEdit'];
    $news_description = $_POST['inputNewsDescriptionEdit'];
    $news_date = $_POST['inputNewsDateEdit'];

    $updateSQL = "UPDATE db_science_university_news 
    SET news_title=?, news_link=?, news_description=?, news_date=?, news_category_category_id=?
    WHERE id='$id'";
    $result = $conn->prepare($updateSQL);
    $runQuery = $result->execute([$news_title, $news_link, $news_description, $news_date, $news_category]);
    if($runQuery){
        header('Location: ../../news.php');
    } else {
        echo 'failed to update';
        header('Location: ../../news.php');
    }
}
?>