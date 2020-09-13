<?php
session_start();
require_once '../../database.php';


$id = $_POST['id'];
$SQL = "SELECT admission.admission_id, admission.admission_text, admission.admission_button, admission.button_link, admission.is_active
FROM db_science_university_admission as admission
    WHERE admission_id='$id'";
$result = $conn->query($SQL);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$data['admissionName'] = $resultCol["admission_text"];
$data['admissionButton'] = $resultCol["admission_button"];
$data['admissionLink'] = $resultCol["button_link"];
$data['admissionActive'] = $resultCol["is_active"];


echo json_encode($data);

?>