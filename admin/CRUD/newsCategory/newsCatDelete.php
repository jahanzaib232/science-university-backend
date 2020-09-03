<?php
require_once '../../database.php';

if(isset($_GET['delete'])){ 
    $id = $_GET['delete'];

    $childSQL = $conn->prepare("DELETE FROM db_science_university_news
    WHERE news_category_category_id=?");
    $childSQLResult = $childSQL->execute([$id]);

    $sql = $conn->prepare("DELETE FROM news_category
    WHERE category_id=? ");
    $result = $sql->execute([$id]);
    if($result){
        header('Location: ../../../newsCategory.php');
    } else {
        echo 'SQL statement DELETE was unsuccessful';
    }
} else {
    echo 'not working';
}

?>