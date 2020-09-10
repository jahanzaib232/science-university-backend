<?php 

include_once('includes/header.php');
include_once('includes/navbar.php');

require_once 'database.php';
$mySQL = "SELECT config.config_id, config.config_name, config.config_value, config.is_active, user.name
FROM db_science_university_config as config JOIN db_science_university_users as user
WHERE user.id = config.db_science_university_users_id";

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
        <h5 class="modal-title" id="exampleModalLongTitle">Config Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/config/configInsert.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputConfigName">Config Name</label>
            <input type="text" class="form-control" id="inputConfigName" name="inputConfigName" placeholder="Enter title" >
          </div>
          <div class="form-group">
            <label for="inputConfigValue">Config Value</label>
            <input type="file" class="form-control" id="inputConfigValue" name="inputConfigValue" aria-describedby="emailHelp" placeholder="Enter link" >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputConfigActive" name="inputConfigActive" value="1" >
            <label for="inputConfigActive">Yes</label>
                  
            <input type="radio" id="inputConfigActive" name="inputConfigActive" value="0" >
            <label for="inputConfigActive">No</label>

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
        <h5 class="modal-title" id="exampleModalLongTitle">Config Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/config/configUpdate.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputConfigNameEdit">Config Name</label>
            <input type="text" class="form-control" id="inputConfigNameEdit" name="inputConfigNameEdit" >
          </div>
          <div class="form-group">
            <label for="inputConfigValueEdit">Config Value</label>
            <input type="file" class="form-control" id="inputConfigValueEdit" name="inputConfigValueEdit" aria-describedby="emailHelp" placeholder="Enter link" >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputConfigActiveEdit" name="inputConfigActiveEdit" value="1" >
            <label for="inputConfigActiveEdit">Yes</label>
                  
            <input type="radio" id="inputConfigActiveEdit" name="inputConfigActiveEdit" value="0" >
            <label for="inputConfigActiveEdit">No</label>

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
            <h6 class="m-0 font-weight-bold text-primary">Config
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addnav">
                    Add Config
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Config Name</th>
                            <th>Config Value</th>
                            <th>Is Active</th>
                            <th>Admin</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch()): ?>
                        <tr>
                            <td><?php echo $row['config_name'];?></td>
                            <td><?php echo $row['config_value'];?></td>
                            <td><?php echo $row['is_active'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                            <input 
                            type="button" 
                            name="edit" 
                            value="Edit" 
                            id="<?php echo $row["config_id"]; ?>" 
                            class="btn btn-secondary btn-xs edit_data" />
                              <a 
                              href="CRUD/config/configDelete.php/?delete=<?php echo $row["config_id"];?>" 
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
    url: 'CRUD/config/getInfo.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      newdata = JSON.parse(data);
      // alert(data);
      $('#updaterow').modal('show');
      $('#inputConfigNameEdit').val(newdata.configName);
      $('#inputConfigValueEdit').val(newdata.configValue);
      $('#inputConfigActiveEdit').val(newdata.configActive);
    }
  });
});
</script>