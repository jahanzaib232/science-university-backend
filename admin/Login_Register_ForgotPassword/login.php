<?php
session_start();
require_once '../database.php';

if(isset($_POST['loginBtn'])){
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
    
    
    $salt = 'ERigjdsg943dg'.$password;
    $hashedPassword = hash('sha512', $salt);

    $sqlHashedPasswordInDB = "SELECT COUNT(*) FROM db_science_university_users WHERE email=?";
    $result = $conn->prepare($sqlHashedPasswordInDB);
    $result->execute([$email]);
    $number_of_rows = $result->fetchColumn();

    foreach($conn->query("SELECT * FROM db_science_university_users") as $row){
        if($row['email'] === $email){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['dateOfBirth'] = $row['DoB'];
        }
    }
    
    if($number_of_rows > 0){
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