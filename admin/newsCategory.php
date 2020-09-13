<?php 
include('includes/header.php');
include('includes/navbar.php');

require_once 'database.php';
$sql = "SELECT news_cat.category_id, news_cat.category_name, user.name
FROM news_category as news_cat JOIN db_science_university_users as user
WHERE user.id = news_cat.db_science_university_users_id";
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

<div class="modal fade" id="addnews" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">News Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/newsCategory/newsCatInsert.php">
          <div class="form-group">
            <label for="inputNewsCategory">News Category</label>
            <input type="text" class="form-control" id="inputNewsCategory" name="inputNewsCategory" placeholder="Enter Category"  >
          </div>
          <button type="submit" class="btn btn-primary" id="submitBtn" name="submitBtn">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- edit nav row modal start -->

<div class="modal fade" id="updaterow" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">News Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/newsCategory/newsCatUpdate.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputNewsCategoryEdit">News Category</label>
            <input type="text" class="form-control" id="inputNewsCategoryEdit" name="inputNewsCategoryEdit" placeholder="Enter Category"  >
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
            <h6 class="m-0 font-weight-bold text-primary">News
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addnews">
                    Add Category
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
        
                        <tr>
                            <th>Category ID</th>
                            <th>News Category Title</th>
                            <th>Admin</th>
                            <th>Operations</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch()): ?>
                        <tr>
                            <td><?php echo $row['category_id'];?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                            <input 
                            type="button" 
                            name="edit" 
                            value="Edit" 
                            id="<?php echo $row["category_id"]; ?>" 
                            class="btn btn-secondary btn-xs edit_data" />
                                <a 
                                href="CRUD/newsCategory/newsCatDelete.php/?delete=<?php echo $row['category_id'];?>" 
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
<script>

$(document).on('click', '.edit_data', function(){
  var id = $(this).attr('id');
  $.ajax({
    url: 'CRUD/newsCategory/newsCatUpdate.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      var returnedvalue = data;
      // alert(id);
      $('#updaterow').modal('show');
      $('#id_hidden').val(id);
  }
  });
});
</script>