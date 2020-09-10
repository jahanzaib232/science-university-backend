<?php 
session_start();
if(isset($_POST['logout_btn'])){
    echo 'success';
    unset($_SESSION['username']);
    $unsetUsername = $_SESSION['username']; 
    if(!isset($_SESSION['username'])){
        echo 'success inner';
        header('Location: ../login.html');
        exit;
    } else {
        header('Location: ../login.html');
    }
} else {
    header('Location: ../login.html');
}
?>