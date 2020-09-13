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

    // PDO data retreival of email if it already exists
    $sql = "SELECT COUNT(*) FROM db_science_university_users WHERE email=?"; 
    $result = $conn->prepare($sql); 
    $result->execute([$email]); 
    $number_of_rows = $result->fetchColumn(); 

    // retrieve number of rows if email exists
    if($pass === $confPass && $number_of_rows == 0){
        // insert into db values
        $sqlInsert = "INSERT INTO db_science_university_users (name, email, password, DoB) VALUES ('$name', '$email', '$hashedPassword', '$dateOfBirth')";
        $runQuery = $conn->exec($sqlInsert);
        if($runQuery){
            header('Location: ../login.html');
        } else {
            $runQuery->errorInfo();
            header('Location: ../register.html');
        }
    } else {
        header('Location: ../register.html');
        echo 'Password does not match or email already exists';

    }
}
?>