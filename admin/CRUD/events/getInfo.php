<?php
session_start();
require_once '../../database.php';


$id = $_POST['id'];
$SQL = "SELECT events.event_title, events.event_description, events.event_image, events.event_date, events.event_start_time, events.event_end_time, events.event_location, events_cat.category_name, events.is_active
FROM db_science_university_events as events JOIN events_category as events_cat
WHERE id='$id'";
$result = $conn->query($SQL);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$data['eventTitle'] = $resultCol["event_title"];
$data['catName'] = $resultCol["category_name"];
$data['eventDescription'] = $resultCol["event_description"];
$data['eventImage'] = $resultCol["event_image"];
$data['eventDate'] = $resultCol["event_date"];
$data['eventStartTime'] = $resultCol["event_start_time"];
$data['eventEndTime'] = $resultCol["event_end_time"];
$data['eventLocation'] = $resultCol["event_location"];
$data['eventsActive'] = $resultCol["is_active"];

echo json_encode($data);

?>