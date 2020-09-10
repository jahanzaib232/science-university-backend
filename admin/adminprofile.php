<?php
require_once 'database.php';

$sql = "SELECT user.id, user.name, user.email, user.DoB FROM db_science_university_users as user ";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);

?>
<?php 
include('includes/header.php');
include('includes/navbar.php');?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sign up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/code.php">
          <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Enter name" required>
          </div>
          <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="inputConfirmPassword">Confirm Password</label>
            <input type="password" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword" placeholder="Confirm Password" required>
          </div>
          <div class="form-group">
            <label for="inputDate">Date of Birth</label>
              <input class="form-control" type="date" id="inputDate" name="inputDate" required>
          </div>
          <button type="submit" class="btn btn-primary" id="submitBtn" name="submitBtn">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Admin Profile
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                    Add Admin Profile
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while($row = $result->fetch()): ?>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['DoB'];?></td>
                            <td>
                              <a 
                              href="CRUD/login/loginDelete.php/?delete=<?php echo $row['id'];?>" 
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
include('matchingPassword.php');
include('includes/footer.php');
?>