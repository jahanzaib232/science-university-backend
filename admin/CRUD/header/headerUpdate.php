<?php
session_start();
require_once '../../database.php';
if(isset($_POST['updateBtn'])){

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";

    $id = $_POST['id_hidden'];

    $sql = "SELECT header.image_path_file, header.header_title, header.header_text, header.order_ FROM db_science_university_header header WHERE header_id='$id'";
    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $resultCol = $result->fetch();


    $header_title = $_POST['inputHeaderTitleEdit'];
    $header_image = $_FILES['inputHeaderImageEdit']['name'];
    $header_text = $_POST['inputHeaderTextEdit'];
    $header_order = $_POST['inputHeaderOrderEdit'];

    $updateSQL = "UPDATE db_science_university_header SET image_path_file=?, header_title=?, header_text=?, order_=? WHERE header_id='$id'";
    $result = $conn->prepare($updateSQL);
    $runQuery = $result->execute([$header_image, $header_title, $header_text, $header_order]);
    if($runQuery){
        header('Location: ../../header.php');
    } else {
        echo 'failed to update';
        header('Location: ../../header.php');
    }
}
?>