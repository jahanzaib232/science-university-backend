<?php
session_start();
require_once '../database.php';

if(isset($_POST['loginBtn'])){
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
    
    
    $salt = 'ERigjdsg943dg'.$password;
    $hashedPassword = hash('sha512', $salt);

    $sqlHashedPasswordInDB = "SELECT * FROM db_science_university_users WHERE email='$email'";
    $runQuery = mysqli_query($con, $sqlHashedPasswordInDB);
    $row = mysqli_fetch_assoc($runQuery);

    $_SESSION['username'] = $row['name'];

    // echo $_SESSION['username'];
    if(mysqli_num_rows($runQuery) > 0){
        if($hashedPassword == $row['password']){
            header('Location: ../adminprofile.php');
        }
        else {
            header('Location: ../login.html');
        }
    } else {
        echo 'email doesnt exist';
        header('Location: ../login.html');
    }    
}

?>