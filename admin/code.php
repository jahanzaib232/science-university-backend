<?php

require_once 'database.php';


if(isset($_POST['submitBtn'])){
    
    $name = $_POST['inputName'];
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];
    $confirmPass = $_POST['inputConfirmPassword'];
    $dateOfBirth = $_POST['inputDate'];

    $sql = "SELECT * FROM db_science_university_users WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    if( $password === $confirmPass && !(mysqli_num_rows($result)>0)){
        $salt = 'ERigjdsg943dg'.$password;
        $hashedPassword = hash('sha512', $salt);
        $userInfo = "INSERT INTO db_science_university_users (name, email, password, DoB) VALUES ('$name', '$email', '$hashedPassword', '$dateOfBirth')";
        $runQuery = mysqli_query($con, $userInfo);
        if($runQuery){
            $_SESSION['success'] = "Admin Profile Added!";
            header("Location: register.php");
        } else {
            $_SESSION['status'] = "Admin Profile NOT Added!";
            header('Location: register.php');
        }
    } else {
        $_SESSION['status'] = "Passwords Don't Match";
        // echo '<script type="text/javascript"> alert("Email already exists.. Try another email")</script>';
        header("Location: register.php"); 
    }

    // if database has data in it
    // if(mysqli_num_rows($result)>0){ //true
    //     // data of each row
    //     $row = mysqli_fetch_assoc($result);
    //     if($email == $row['email']) {
    //         echo 'email exists';
    //     } else {
    //         $_SESSION['success'] = "Admin Profile Added!";
    //         header("Location: register.php");
    //     }
    // }
}
?>