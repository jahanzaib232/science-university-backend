<?php 
session_start();
if(isset($_POST['logout_btn'])){
    unset($_SESSION['username']);
    header('Location: ../login.html');

} else {
    header('Location: ../login.html');
}
?>