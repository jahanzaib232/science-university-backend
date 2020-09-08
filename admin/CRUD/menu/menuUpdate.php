<?php
require_once '../../database.php';

$id = $_POST['id_hidden'];

$sql = "SELECT menu.title, menu.text, menu.icon, menu.url, menu.parent, menu.type FROM db_science_university_menu menu WHERE menu_id='$id'";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();
var_dump($resultCol);
$menuTitle = $_POST['inputMenuTitleEdit'];
$menuText = $_POST['inputMenuTextEdit'];
$menuIcon = $_FILES["inputMenuIconEdit"]["name"]; 
$menuUrl = $_POST['inputMenuUrlEdit'];
$menuParent = $_POST['inputMenuParentEdit'];
$menuType = $_POST['inputMenuTypeEdit'];

$updateSQL = "UPDATE db_science_university_menu SET title=?, text=?, icon=?, url=?, parent=?, type=? WHERE menu_id='$id'";
$result = $conn->prepare($updateSQL);
$runQuery = $result->execute([$menuTitle, $menuText, $menuIcon, $menuUrl, $menuParent, $menuType]);
if($runQuery){
    header('Location: ../../menu.php');
} else {
    echo 'failed to update';
    header('Location: ../../menu.php');
}
?>