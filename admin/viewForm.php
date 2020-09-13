<?php
include('includes/header.php');
include('includes/navbar.php');
require_once 'database.php';


if(isset($_GET['form_id'])){
    $id = $_GET['form_id'];
    $SQL = "SELECT id, form_sender_name, form_sender_phone, form_sender_email, form_sender_message, time_stamp 
    FROM db_science_university_forms 
    WHERE id='$id'";
    $result = $conn->query($SQL);
    $result->execute();
    foreach($result as $row){
        $senderID = $row['id'];
        $senderName = $row['form_sender_name'];
        $senderPhone = $row['form_sender_phone'];
        $senderEmail = $row['form_sender_email'];
        $senderMessage = $row['form_sender_message'];
        $timeStamp = $row['time_stamp'];

        echo "<div><h3>Form ID: $senderID</h3></div>";
        echo "<form class='m-5' method='POST' action='forms.php'>";
        echo "<div class='form-group'>";
        echo "<label for='exampleFormControlFile1'>";
        echo "Sender Name: ";
        echo "</label>";
        echo "<input type='text' class='form-control' id='senderName' name='senderName' value='$senderName' readonly>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='exampleFormControlFile1'>";
        echo "Sender Phone: ";
        echo "</label>";
        echo "<input type='text' class='form-control' id='senderName' name='senderName' value='$senderPhone' readonly>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='exampleFormControlFile1'>";
        echo "Sender Email: ";
        echo "</label>";
        echo "<input type='text' class='form-control' id='senderName' name='senderName' value='$senderEmail' readonly>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='exampleFormControlFile1'>";
        echo "Sender Message: ";
        echo "</label>";
        echo "<textarea rows='5' cols='100' class='form-control' id='senderName' name='senderName' readonly>$senderMessage</textarea>";
        echo "</div>";
        echo "<div class='form-group'>";
        echo "<label for='exampleFormControlFile1'>";
        echo "Time Stamp: ";
        echo "</label>";
        echo "<input type='text' class='form-control' id='senderName' name='senderName' value='$timeStamp' readonly>";
        echo "</div>";
        echo "<div class='float-right'>";
        echo "<button type='submit' class='btn btn-primary mr-3' id='read' name='submitBtn'>Read</button>";
        echo "<button type='button' class='btn btn-secondary' name='closeForm' onclick='return returnFunction();'>Return</button>";
        echo "</div>";
        echo "</form>";

        // $array = array($senderID);
        // $_SESSION['formsThatHaveBeenRead'] = $array;
    }
}

include('includes/script.php');
include('includes/footer.php');
?>

<script>
function returnFunction(){
window.location.href = 'forms.php';
}
</script>