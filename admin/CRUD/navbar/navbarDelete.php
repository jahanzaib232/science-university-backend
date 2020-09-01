<?php
require_once '../../database.php';

if(isset($_GET['deleteBtn'])){ 
    echo $_GET['deleteBtn'];
    // $sql = "DELETE FROM db_science_university_navbar WHERE id=?";
    // $selectSQL->execute([$id]);
} else {
    echo 'not working';
}

?>