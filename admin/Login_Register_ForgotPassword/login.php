<?php

// require_once '../database.php';

if(isset($_POST['loginBtn'])){

    // header('Location: ../adminprofile.php');
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
    
    
    $salt = 'ERigjdsg943dg'.$password;
    $hashedPassword = hash('sha512', $salt);

    $sqlHashedPasswordInDB = "SELECT * FROM db_science_university_users WHERE email='$email'";
    $runQuery = mysqli_query($con, $sqlHashedPasswordInDB);

    if(mysqli_num_rows($runQuery) > 0){
        $row = mysqli_fetch_assoc($runQuery);
        
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