<?php
session_start();
require_once '../../database.php';

if(isset($_GET['delete'])){ 
    $_SESSION['message'] = "Record has been deleted successfully";
    $_SESSION['msg_type'] = "danger";

    $id = $_GET['delete'];
    $sql = $conn->prepare("DELETE FROM db_science_university_forms WHERE id=?");
    $result = $sql->execute([$id]);
    if($result){
        header("Location: ../../../forms.php");
    } else {
        echo 'SQL statement DELETE was unsuccessful';
        header('Location: ../../../forms.php');

    }
} else {
    echo 'not working';
    header('Location: ../../../forms.php');
}
?>