<?php
require_once '../../database.php';

$id = $_POST['id_hidden'];

$sql = "SELECT nav.nav_link, nav.nav_title FROM db_science_university_navbar nav WHERE id='$id'";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$resultCol = $result->fetch();

$nav_title_edit = $_POST['inputNavTitleEdit'];
$nav_link_edit = $_POST['inputNavLinkEdit'];

$updateSQL = "UPDATE db_science_university_navbar SET nav_title=?, nav_link=? WHERE id='$id'";
$result = $conn->prepare($updateSQL);
$runQuery = $result->execute([$nav_title_edit, $nav_link_edit]);
if($runQuery){
    header('Location: ../../navbarPages.php');
} else {
    echo 'failed to update';
    header('Location: ../../navbarPages.php');
}
?>