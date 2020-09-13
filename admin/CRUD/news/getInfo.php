<?php
session_start();
require_once '../../database.php';


$id = $_POST['id'];
$SQL = "SELECT news.news_title, news.news_link, news.news_description, news.news_date, news.is_active, news_cat.category_name
FROM db_science_university_news as news JOIN news_category as news_cat
WHERE id='$id'";
$result = $conn->query($SQL);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$data['newsTitle'] = $resultCol["news_title"];
$data['newsLink'] = $resultCol["news_link"];
$data['newsDescription'] = $resultCol["news_description"];
$data['newsDate'] = $resultCol["news_date"];
$data['newsActive'] = $resultCol["is_active"];
$data['catName'] = $resultCol["category_name"];


echo json_encode($data);

?>