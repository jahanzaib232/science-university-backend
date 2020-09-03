<?php
require_once '../../database.php';

if(isset($_GET['delete'])){ 
    $id = $_GET['delete'];
    $sql = $conn->prepare("DELETE FROM db_science_university_courses WHERE id=?");
    $result = $sql->execute([$id]);
    if($result){
        header('Location: ../../../courses.php');
    } else {
        echo 'SQL statement DELETE was unsuccessful';
    }
} else {
    echo 'not working';
}

?>