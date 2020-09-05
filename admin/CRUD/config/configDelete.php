<?php
require_once '../../database.php';

if(isset($_GET['delete'])){ 
    $id = $_GET['delete'];
    $sql = $conn->prepare("DELETE FROM db_science_university_config WHERE config_id=?");
    $result = $sql->execute([$id]);
    if($result){
        header('Location: ../../../config.php');
    } else {
        echo 'SQL statement DELETE was unsuccessful';
    }
} else {
    echo 'not working';
}

?>