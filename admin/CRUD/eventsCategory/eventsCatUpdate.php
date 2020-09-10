<?php
session_start();
require_once '../../database.php';
if(isset($_POST['updateBtn'])){

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";
    $id = $_POST['id_hidden'];

    $sql = "SELECT events_cat.category_name 
    FROM events_category events_cat
    WHERE category_id='$id'";

    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $resultCol = $result->fetch();
    // var_dump($resultCol);
    $category_name = $_POST['inputEventsCategoryEdit'];

    $updateSQL = "UPDATE events_category 
    SET category_name=?
    WHERE category_id='$id'";
    $result = $conn->prepare($updateSQL);
    $runQuery = $result->execute([$category_name]);
    if($runQuery){
        header('Location: ../../eventsCategory.php');
    } else {
        echo 'failed to update';
        header('Location: ../../eventsCategory.php');
    }
}
?>