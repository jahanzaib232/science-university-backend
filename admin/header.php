<?php 
include_once('includes/header.php');
include_once('includes/navbar.php');
?>

<?php
require_once 'database.php';

$sql = "SELECT header.header_id, header.image_path_file, header.header_text, header.header_title, header.order_, user.name 
FROM db_science_university_header as header JOIN db_science_university_users as user 
WHERE user.id = header.db_science_university_users_id";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);

?>

<!-- add nav modal start -->
<div class="modal fade" id="addnav" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Header Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/header/headerInsert.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputHeaderTitle">Header Title</label>
            <input type="text" class="form-control" id="inputHeaderTitle" name="inputHeaderTitle" placeholder="Enter title" required>
          </div>
          <div class="form-group">
            <label for="inputHeaderImage">Header Image</label>
            <input type="file" class="form-control" id="inputHeaderImage" name="inputHeaderImage" aria-describedby="emailHelp" placeholder="Enter link" required>
          </div>
          <div class="form-group">
            <label for="inputHeaderText">Header Text</label>
            <input type="text" class="form-control" id="inputHeaderText" name="inputHeaderText" aria-describedby="emailHelp" placeholder="Enter link" required>
          </div>
          <div class="form-group">
            <label>Order<br>
            <input type="radio" id="inputHeaderOrder" name="inputHeaderOrder" value="0" required>
            <label for="inputHeaderOrder">1</label>
                  
            <input type="radio" id="inputHeaderOrder" name="inputHeaderOrder" value="1" required>
            <label for="inputHeaderOrder">2</label>

            <input type="radio" id="inputHeaderOrder" name="inputHeaderOrder" value="2" required>
            <label for="inputHeaderOrder">3</label>

            <input type="radio" id="inputHeaderOrder" name="inputHeaderOrder" value="3" required>
            <label for="inputHeaderOrder">4</label>

            <input type="radio" id="inputHeaderOrder" name="inputHeaderOrder" value="4" required>
            <label for="inputHeaderOrder">5</label>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Header Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/header/headerUpdate.php">
          <div class="form-group">
            <label for="inputNavTitle">Navigation Title</label>
            <input type="text" class="form-control" id="inputNavTitle" name="inputNavTitle"
            placeholder="" 
             required>
          </div>
          <div class="form-group">
            <label for="inputHeaderOrder">Navigation Link</label>
            <input type="radio" class="form-control" id="inputHeaderOrder" name="inputHeaderOrder" 
            placeholder="" 
            required>
          </div>
          <button type="submit" class="btn btn-primary" id="submitBtn" name="submitBtn">Submit</button>
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
            <h6 class="m-0 font-weight-bold text-primary">Header
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addnav">
                    Add Header
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Header Title</th>
                            <th>Header Image</th>
                            <th>Header Text</th>
                            <th>Header Order</th>
                            <th>Admin</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['header_title'];?></td>
                            <td><?php echo $row['image_path_file'];?></td>
                            <td><?php echo $row['header_text'];?></td>
                            <td><?php echo $row['order_'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                              <a 
                              data-toggle="modal" 
                              data-target="#updaterow"
                              href="CRUD/header/headerUpdate.php/?edit=<?php echo $_SESSION['edit'] = $row["id"];?>" 
                              class="btn btn-secondary">Edit</a>
                              <a 
                              href="CRUD/header/headerDelete.php/?delete=<?php echo $row["header_id"];?>" 
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