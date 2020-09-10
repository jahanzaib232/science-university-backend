<?php
session_start();
require_once '../../database.php';
if(isset($_POST['updateBtn'])){

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";

    $id = $_POST['id_hidden'];
    $nav_title_edit = $_POST['inputNavTitleEdit'];
    $nav_link_edit = $_POST['inputNavLinkEdit'];
    if(isset($_POST['updateBtn'])){
        $updateSQL = "UPDATE db_science_university_navbar SET nav_title=?, nav_link=? WHERE id='$id'";
        $result = $conn->prepare($updateSQL);
        $runQuery = $result->execute([$nav_title_edit, $nav_link_edit]);
        if($runQuery){
            header('Location: ../../navbarPages.php');
        } else {
            echo 'failed to update';
            header('Location: ../../navbarPages.php');
        }
    }
}
?>