<?php 
include_once('includes/header.php');
include_once('includes/navbar.php');
?>

<?php
require_once 'database.php';

$sql = "SELECT n.id, n.nav_title, n.nav_link, n.is_active, user.name 
FROM db_science_university_navbar as n JOIN db_science_university_users as user 
WHERE user.id = n.db_science_university_users_id";
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


<!-- add nav modal start -->
<div class="modal fade" id="addnav" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Navbar Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/navbar/navbarInsert.php">
          <div class="form-group">
            <label for="inputNavTitle">Navigation Title</label>
            <input type="text" class="form-control" id="inputNavTitle" name="inputNavTitle" placeholder="Enter title"  >
          </div>
          <div class="form-group">
            <label for="inputNavLink">Navigation Link</label>
            <input type="link" class="form-control" id="inputNavLink" name="inputNavLink" aria-describedby="emailHelp" placeholder="Enter link"  >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputNavbarActive" name="inputNavbarActive" value="1" >
            <label for="inputNavbarActive">Yes</label>
                  
            <input type="radio" id="inputNavbarActive" name="inputNavbarActive" value="0" >
            <label for="inputNavbarActive">No</label>

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
        <h5 class="modal-title" id="exampleModalLongTitle">Navbar Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/navbar/navbarUpdate.php">
          <div class="form-group">
            <label for="inputNavTitleEdit">Navigation Title</label>
            <input type="text" class="form-control" id="inputNavTitleEdit" name="inputNavTitleEdit"
            placeholder="Enter title" 
              >
          </div>
          <div class="form-group">
            <label for="inputNavLinkEdit">Navigation Link</label>
            <input type="link" class="form-control" id="inputNavLinkEdit" name="inputNavLinkEdit" 
            placeholder="Enter link" 
             >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputNavbarActiveEdit_1" name="inputNavbarActiveEdit" value="1" >
            <label for="inputNavbarActiveEdit_1">Yes</label>
                  
            <input type="radio" id="inputNavbarActiveEdit_0" name="inputNavbarActiveEdit" value="0" >
            <label for="inputNavbarActiveEdit_0">No</label>
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
            <h6 class="m-0 font-weight-bold text-primary">Navbar
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addnav">
                    Add Navigation
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Navigation Title</th>
                            <th>Navigation Link</th>
                            <th>Is Active</th>
                            <th>Admin</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while($row = $result->fetch()): ?>
                        <tr>
                            <td><?php echo $row['nav_title']?></td>
                            <td><?php echo $row['nav_link']?></td>
                            <td><?php echo $row['is_active']?></td>
                            <td><?php echo $row['name']?></td>
                            <td>
                            <input 
                            type="button" 
                            name="edit" 
                            value="Edit" 
                            id="<?php echo $row["id"]; ?>" 
                            class="btn btn-secondary btn-xs edit_data" />
                              <a 
                              href="CRUD/navbar/navbarDelete.php/?delete=<?php echo $row["id"];?>" 
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
include('includes/footer.php');
?>

<script>

$(document).on('click', '.edit_data', function(){
  var id = $(this).attr('id');
  $('#id_hidden').val(id);  
  $.ajax({
    url: 'CRUD/navbar/getInfo.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      newdata = JSON.parse(data);
      $('#updaterow').modal('show');
      $('#inputNavTitleEdit').val(newdata.navTitle);
      $('#inputNavLinkEdit').val(newdata.navLink);

      $('#inputNavbarActiveEdit_1').val(newdata.isActive);
      $('#inputNavbarActiveEdit_0').val(newdata.isActive);
      if(newdata.isActive == 1){
        $('#inputNavbarActiveEdit_1').prop('checked', true);
      } else {
        $('#inputNavbarActiveEdit_0').prop('checked', true);

      }

  }
  });
});
</script>