<?php
session_start();
require_once '../../database.php';
if(isset($_POST['updateBtn'])){

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";

    $id = $_POST['id_hidden'];

    $sql = "SELECT footer.parent_title, footer.item_list, footer.item_icon, footer.item_link, footer.image_, footer.is_active FROM db_science_university_footer footer WHERE footer_id='$id'";
    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $resultCol = $result->fetch();

    $parentTitle = $_POST['inputParentTitleEdit'];
    $itemList = $_POST['inputItemListEdit'];
    $itemIcon = $_POST["inputItemIconEdit"]; 
    $itemLink = $_POST["inputItemLinkEdit"]; 
    $footerImage = $_FILES["inputFooterImageEdit"]["name"]; 
    $footerActive = $_POST['inputFooterActiveEdit'];

    $updateSQL = "UPDATE db_science_university_footer SET parent_title=?, item_list=?, item_link=?, item_icon=?, image_=?, is_active=? WHERE footer_id='$id'";
    $result = $conn->prepare($updateSQL);
    $runQuery = $result->execute([$parentTitle, $itemList, $itemLink, $itemIcon, $footerImage, $footerActive]);
    if($runQuery){
        header('Location: ../../footer.php');
    } else {
        echo 'failed to update';
        header('Location: ../../footer.php');
    }
}
?>