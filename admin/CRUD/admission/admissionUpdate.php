<?php
session_start();
require_once '../../database.php';
if(isset($_POST['updateBtn'])){

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";
    
    $id = $_POST['id_hidden'];
    
    $sql = "SELECT admission.admission_id, admission.admission_text, admission.admission_button, admission.button_link, admission.is_active, user.name
    FROM db_science_university_admission as admission
    WHERE admission_id='$id'";

    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $resultCol = $result->fetch();
    // var_dump($resultCol);
    $admission_name = $_POST['inputAdmissionTitleEdit'];
    $admission_value = $_POST["inputAdmissionButtonTextEdit"]; 
    $admission_link = $_POST['inputAdmissionButtonLinkEdit'];
    $is_active = $_POST['inputAdmissionActiveEdit'];

    $updateSQL = "UPDATE db_science_university_admission 
    SET admission_text=?, admission_button=?, button_link=?, is_active=?
    WHERE admission_id='$id'";
    $result = $conn->prepare($updateSQL);
    $runQuery = $result->execute([$admission_name, $admission_value, $admission_link, $is_active]);
    if($runQuery){
        header('Location: ../../admission.php');
    } else {
        echo 'failed to update';
        header('Location: ../../admission.php');
    }
}
?>