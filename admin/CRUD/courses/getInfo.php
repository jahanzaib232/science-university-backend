<?php
session_start();
require_once '../../database.php';


$id = $_POST['id'];
$SQL = "SELECT courses.category_title, courses.course_image, courses.course_link, courses.is_active
FROM db_science_university_courses as courses
WHERE id='$id'";
$result = $conn->query($SQL);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$data['catTitle'] = $resultCol["category_title"];
$data['courseImage'] = $resultCol["course_image"];
$data['courseLink'] = $resultCol["course_link"];
$data['courseActive'] = $resultCol["is_active"];

echo json_encode($data);

?>