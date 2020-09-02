<?php 
include('includes/header.php');
include('includes/navbar.php');

require_once 'database.php';


$sql = "SELECT courses.category_title, courses.course_image, user.name
FROM db_science_univeristy_courses as courses JOIN db_science_university_users as user
WHERE user.id = courses.db_science_university_user_id";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
?>
<div class="modal fade" id="addcourse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Courses Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/courses/coursesInsert.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputCourseCategory">Course Category</label>
            <input type="text" class="form-control" id="inputCourseCategory" name="inputCourseCategory" placeholder="Enter Category" required>
          </div>
          <div class="form-group">
            <label for="inputCourseImage">Course Image</label>
            <input type="file" class="form-control" id="inputCourseImage" name="inputCourseImage" placeholder="Choose file" required>
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
            <h6 class="m-0 font-weight-bold text-primary">Courses
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcourse">
                    Add Course
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course Category</th>
                            <th>Course Image</th>
                            <th>Added by Admin</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['category_title'];?></td>
                            <td><?php echo $row['course_image'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                              <a href="" class="btn btn-secondary">Edit</a>
                              <a href="" class="btn btn-danger">Delete</a>
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
include('includes/footer.php');?>