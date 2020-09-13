<?php
session_start();
require_once '../../database.php';
if(isset($_POST['updateBtn'])){

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";

    $id = $_POST['id_hidden'];

    $sql = "SELECT menu.title, menu.text, menu.icon, menu.url, menu.type_, menu.is_active FROM db_science_university_menu menu WHERE menu_id='$id'";
    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $resultCol = $result->fetch();
    
    $menuTitle = $_POST['inputMenuTitleEdit'];
    $menuText = $_POST['inputMenuTextEdit'];
    $menuIcon = $_FILES["inputMenuIconEdit"]["name"]; 
    $menuUrl = $_POST['inputMenuUrlEdit'];
    $menuType = $_POST['inputMenuTypeEdit'];
    $menuActive = $_POST['inputMenuActiveEdit'];

  
    $updateSQL = "UPDATE db_science_university_menu SET title=?, text=?, icon=?, url=?, type_=?, is_active=? WHERE menu_id='$id'";
    $result = $conn->prepare($updateSQL);
    $runQuery = $result->execute([$menuTitle, $menuText, $menuIcon, $menuUrl, $menuType, $menuActive]);
    if($runQuery){
        header('Location: ../../menu.php');
    } else {
        echo 'failed to update';
        header('Location: ../../menu.php');
    }
}
?>