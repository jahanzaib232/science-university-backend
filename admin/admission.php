<?php 

include_once('includes/header.php');
include_once('includes/navbar.php');

require_once 'database.php';
$mySQL = "SELECT admission.admission_id, admission.admission_text, admission.admission_button, admission.button_link, admission.is_active, user.name
FROM db_science_university_admission as admission JOIN db_science_university_users as user
WHERE user.id = admission.db_science_university_users_id";

$result = $conn->query($mySQL);
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

<!-- add nav modal start -->
<div class="modal fade" id="addnav" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Admission Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/admission/admissionInsert.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputAdmissionTitle">Admission Title</label>
            <input type="text" class="form-control" id="inputAdmissionTitle" name="inputAdmissionTitle" placeholder="Enter title" >
          </div>
          <div class="form-group">
            <label for="inputAdmissionButtonText">Admission Button Text</label>
            <input type="text" class="form-control" id="inputAdmissionButtonText" name="inputAdmissionButtonText" placeholder="Enter text" >
          </div>
          <div class="form-group">
            <label for="inputAdmissionButtonLink">Admission Button Link</label>
            <input type="text" class="form-control" id="inputAdmissionButtonLink" name="inputAdmissionButtonLink" placeholder="Enter link" >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputAdmissionActive" name="inputAdmissionActive" value="1" >
            <label for="inputAdmissionActive">Yes</label>
                  
            <input type="radio" id="inputAdmissionActive" name="inputAdmissionActive" value="0" >
            <label for="inputAdmissionActive">No</label>

            </label>
          </div>
          <button type="submit" class="btn btn-primary" id="submitBtn" name="submitBtn">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- add nav modal end -->

<!-- edit nav row modal start -->

<div class="modal fade" id="updaterow" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Admission Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/admission/admissionUpdate.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputAdmissionTitleEdit">Admission Title</label>
            <input type="text" class="form-control" id="inputAdmissionTitleEdit" name="inputAdmissionTitleEdit" >
          </div>
          <div class="form-group">
            <label for="inputAdmissionButtonTextEdit">Admission Button Text</label>
            <input type="text" class="form-control" id="inputAdmissionButtonTextEdit" name="inputAdmissionButtonTextEdit" placeholder="Enter text" >
          </div>
          <div class="form-group">
            <label for="inputAdmissionButtonLinkEdit">Admission Button Link</label>
            <input type="text" class="form-control" id="inputAdmissionButtonLinkEdit" name="inputAdmissionButtonLinkEdit" placeholder="Enter link" >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputAdmissionActiveEdit" name="inputAdmissionActiveEdit" value="1" >
            <label for="inputAdmissionActiveEdit">Yes</label>
                  
            <input type="radio" id="inputAdmissionActiveEdit" name="inputAdmissionActiveEdit" value="0" >
            <label for="inputAdmissionActiveEdit">No</label>

            </label>
          </div>
          <input type="hidden" name="id_hidden" id="id_hidden">  
          <button type="submit" class="btn btn-primary" id="insert" name="updateBtn">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- edit nav row modal end -->

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admission 
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addnav">
                    Add Admission
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Admission Title</th>
                            <th>Admission Button Text</th>
                            <th>Admission Button Link</th>
                            <th>Is Active</th>
                            <th>Admin</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch()): ?>
                        <tr>
                            <td><?php echo $row['admission_text'];?></td>
                            <td><?php echo $row['admission_button'];?></td>
                            <td><?php echo $row['button_link'];?></td>
                            <td><?php echo $row['is_active'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                            <input 
                            type="button" 
                            name="edit" 
                            value="Edit" 
                            id="<?php echo $row["admission_id"]; ?>" 
                            class="btn btn-secondary btn-xs edit_data" />
                              <a 
                              href="CRUD/admission/admissionDelete.php/?delete=<?php echo $row["admission_id"];?>" 
                              class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
include('includes/script.php');
include('includes/footer.php');
?>
<script>

$(document).on('click', '.edit_data', function(){
  console.log('Works');
  var id = $(this).attr('id');
  $('#id_hidden').val(id);  
  $.ajax({
    url: 'CRUD/admission/getInfo.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      newdata = JSON.parse(data);
      // alert(data);
      $('#updaterow').modal('show');
      $('#inputAdmissionTitleEdit').val(newdata.admissionName);
      $('#inputAdmissionButtonTextEdit').val(newdata.admissionButton);
      $('#inputAdmissionButtonLinkEdit').val(newdata.admissionLink);
      $('#inputAdmissionActiveEdit').val(newdata.admissionActive);
    }
  });
});
</script>