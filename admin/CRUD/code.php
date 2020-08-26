<?php

require '../database.php';


if(isset($_POST['submitBtn'])){
    
    $name = $_POST['inputName'];
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];
    $confirmPass = $_POST['inputConfirmPassword'];
    $dateOfBirth = $_POST['inputDate'];

    // hash password
    $salt = 'ERigjdsg943dg'.$password;
    $hashedPassword = hash('sha512', $salt);

    // select from users where email already exists
    $sql = "SELECT * FROM db_science_university_users WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    $numOfRows = mysqli_num_rows($result);

    if( $password === $confirmPass){
        // if email doesnt exist in database
        if($numOfRows == 0){
            // insert into db
            $userInfo = "INSERT INTO db_science_university_users (name, email, password, DoB) VALUES ('$name', '$email', '$hashedPassword', '$dateOfBirth')";
            $runQuery = mysqli_query($con, $userInfo);
            if($runQuery){
                header("Location: ../adminprofile.php");
            } else {
                header('Location: ../adminprofile.php');
                echo 'DID NOT insert into database';
            }
        } else {
            echo 'email already exists';
        }
    } else {
        header("Location: ../adminprofile.php"); 
        echo 'password doesnt match';

    }
}
?>