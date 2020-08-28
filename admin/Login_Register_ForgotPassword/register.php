<?php
require_once '../database.php';


if(isset($_POST['registerBtn'])){
    $name = $_POST['inputName'];
    $dateOfBirth = $_POST['inputDOB'];
    $email = $_POST['inputEmail'];
    $pass = $_POST['inputPass'];
    $confPass = $_POST['inputConfPass'];

    // hash password
    $salt = 'ERigjdsg943dg'.$pass;
    $hashedPassword = hash('sha512', $salt);

    // select from db where email already exists
    $sqlSelectEmailExists = "SELECT email FROM db_science_university_users WHERE email='$email'";
    $runSelectQuery = mysqli_query($con, $sqlSelectEmailExists);
    
    // retrieve number of rows if email exists
    $numOfRows = mysqli_num_rows($runSelectQuery);
    
    if($pass === $confPass && $numOfRows == 0){
        // insert into db values
        $sqlInsert = "INSERT INTO db_science_university_users (name, email, password, DoB) VALUES ('$name', '$email', '$hashedPassword', '$dateOfBirth')";
        $runQuery = mysqli_query($con, $sqlInsert);
        if($runQuery){
            header('Location: ../login.html');
        } else {
            echo mysqli_error($con);
            header('Location: ../register.html');
        }
    } else {
        header('Location: ../register.html');
        echo 'Password does not match or email already exists';

    }
}
?>