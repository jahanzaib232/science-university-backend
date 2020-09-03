<?php
session_start();
require_once '../../database.php';



$nav_title = $_POST['inputNavTitle'];
$nav_link = $_POST['inputNavLink'];

echo $_SESSION['edit'];

// if(isset($_POST['submitBtn'])){ 

//     $sql = $conn->prepare("UPDATE db_science_university_navbar SET  nav_title=?, nav_link=? WHERE id=?");
//     $result = $sql->execute([$nav_title, $nav_link, $edit_id]);
   
//     if($result){
//         header('Location: ../../navbarPages.php');
//     } else {
//         echo 'SQL statement UPDATE was unsuccessful';
//     }
// } else {
//     echo 'not working';
// }
?>