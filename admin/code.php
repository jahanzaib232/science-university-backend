<?php

require 'database.php';
$name = $_POST['inputName'];
$email = $_POST['inputEmail'];
$password = $_POST['inputPassword'];
$confirmPass = $_POST['inputConfirmPassword'];
$dateOfBirth = $_POST['inputDate'];


if(isset($_POST['submitBtn'])){
    $sql = "SELECT * FROM db_science_university_users WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    // if database has data in it
    if(mysqli_num_rows($result)>0){ //true
        // data of each row
        $row = mysqli_fetch_assoc($result);

        if($email == $row['email']){
            echo 'email exists';
            // echo "<script>
            // $(window).load(function(){
            //     $('#userExists').modal('show');
            // });
            // </script>";
            // include 'userExists.php';
        } else {
            $salt = 'ERigjdsg943dg'.$password;
            $hashedPassword = hash('sha512', $salt);
            
            $userInfo = "INSERT INTO db_science_university_users VALUES('$name', '$email', '$hashedPassword', '2004-08-09')";
            $runQuery = mysqli_query($con, $userInfo);
            if($runQuery){
                echo 'email inserted successfully';
            }
            // echo 'email doesnt exist';
        }
    } 
    // else {
    //     $salt = 'ERigjdsg943dg'.$password;
    //     $hashedPassword = hash('sha512', $salt);

    //     $userInfo = "INSERT INTO db_science_university_users values('$name', '$email', '$hashedPassword', '$dateOfBirth')";
    //     $runQuery = mysqli_query($con, $userInfo);
    //     if($runQuery){
    //         // echo "<script>
    //         // $(window).load(function(){
    //         //     $('#adminInsertedSuccessfully').modal('show');
    //         // });
    //         // </script>";
    //         // include 'adminInsertedSuccessfully.php';
    //     }
    // }
}
?>