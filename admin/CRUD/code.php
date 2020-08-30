<?php

require_once '../database.php';


if(isset($_POST['submitBtn'])){
    
    $name = $_POST['inputName'];
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];
    $confirmPass = $_POST['inputConfirmPassword'];
    $dateOfBirth = $_POST['inputDate'];

    // hash password
    $salt = 'ERigjdsg943dg'.$password;
    $hashedPassword = hash('sha512', $salt);

    // PDO data retreival of email if it already exists
    $sql = "SELECT COUNT(*) FROM db_science_university_users WHERE email=?"; 
    $result = $conn->prepare($sql); 
    $result->execute([$email]); 
    $number_of_rows = $result->fetchColumn(); 

    if( $password === $confirmPass){
        // if email doesnt exist in database
        if($number_of_rows == 0){
            // insert into db values
            $sqlInsert = "INSERT INTO db_science_university_users (name, email, password, DoB) VALUES ('$name', '$email', '$hashedPassword', '$dateOfBirth')";
            $runQuery = $conn->exec($sqlInsert);
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