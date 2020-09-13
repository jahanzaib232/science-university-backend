<?php
session_start();

require_once '../../database.php';

if(isset($_GET['delete'])){ 
    $_SESSION['message'] = "Record has been deleted successfully";
    $_SESSION['msg_type'] = "danger";

    $id = $_GET['delete'];
    $sql = $conn->prepare("DELETE FROM db_science_university_news WHERE id=?");
    $result = $sql->execute([$id]);
    if($result){
        header('Location: ../../../news.php');
    } else {
        echo 'SQL statement DELETE was unsuccessful';
    }
} else {
    echo 'not working';
}

?>