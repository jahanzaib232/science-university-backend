<?php 

include('includes/header.php');
include('includes/navbar.php');
require_once 'database.php';


$sql = "SELECT form.id, form.form_sender_name, form.form_sender_phone, form.form_sender_email, form.form_sender_message, form.time_stamp
FROM db_science_university_forms as form";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
?>
<?php if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
    ?>
</div>
<?php endif ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Forms Section</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sender Name</th>
                            <th>Sender Message</th>
                            <th>Sender Email</th>
                            <th>Sender Phone Number</th>
                            <th>Time Stamp</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch()):?>
                        <tr class="<?php if($_GET['form_id'] == $row['id']){
                            echo 'bg-success';
                        }?>">
                            <td><?php echo $row['form_sender_name'];?></td>
                            <td><?php echo $row['form_sender_message'];?></td>
                            <td><?php echo $row['form_sender_email'];?></td>
                            <td><?php echo $row['form_sender_phone'];?></td>
                            <td><?php echo $row['time_stamp'];?></td>
                            <!-- $row['time_stamp']; var_dump($_SESSION['formsThatHaveBeenRead']);-->
                            <td>
                                <a 

                                href="viewForm.php?form_id=<?php echo $row['id'];?>" 
                                class="btn btn-secondary">View</a>
                                <a 
                                href="CRUD/form/formDelete.php/?delete=<?php echo $row["id"];?>" 
                                class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 
include('includes/script.php');
include('includes/footer.php');?>