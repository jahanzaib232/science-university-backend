<?php
require_once '../../database.php';


if(isset($_POST['deleteBtn'])){
    $selectSQL = "SELECT * FROM db_science_university_navbar";
    $sql = "DELETE FROM db_science_university_navbar WHERE id=?";
    $conn->exec([]);
    // echo 'delete';
}
?>