<?php 
include('includes/header.php');
include('includes/navbar.php');

require_once 'database.php';


$sql = "SELECT menu.menu_id, menu.title, menu.text, menu.icon, menu.url, menu.type_, user.name
FROM db_science_university_menu as menu JOIN db_science_university_users as user
WHERE user.id = menu.db_science_university_users_id";
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


<div class="modal fade" id="addmenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Social Media Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/menu/menuInsert.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputMenuType">Type</label>
            <input type="text" class="form-control" id="inputMenuType" name="inputMenuType" placeholder="Enter text">
          </div>
          <div class="form-group">
            <label for="inputMenuTitle">Title</label>
            <input type="text" class="form-control" id="inputMenuTitle" name="inputMenuTitle" placeholder="Enter text">
          </div>
          <div class="form-group">
            <label for="inputMenuText">Text</label>
            <input type="text" class="form-control" id="inputMenuText" name="inputMenuText" placeholder="Enter text">
          </div>
          <div class="form-group">
            <label for="inputMenuIcon">Menu Icon</label>
            <input type="file" class="form-control" id="inputMenuIcon" name="inputMenuIcon" placeholder="Choose file">
          </div>
          <div class="form-group">
            <label for="inputMenuUrl">URL</label>
            <input type="link" class="form-control" id="inputMenuUrl" name="inputMenuUrl" placeholder="Enter URL">
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
        <h5 class="modal-title" id="exampleModalLongTitle">Social Media Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/menu/menuUpdate.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputMenuTypeEdit">Type</label>
            <input type="text" class="form-control" id="inputMenuTypeEdit" name="inputMenuTypeEdit" placeholder="Enter text">
          </div>
          <div class="form-group">
            <label for="inputMenuTitleEdit">Title</label>
            <input type="text" class="form-control" id="inputMenuTitleEdit" name="inputMenuTitleEdit" placeholder="Enter text">
          </div>
          <div class="form-group">
            <label for="inputMenuTextEdit">Text</label>
            <input type="text" class="form-control" id="inputMenuTextEdit" name="inputMenuTextEdit" placeholder="Enter text">
          </div>
          <div class="form-group">
            <label for="inputMenuIconEdit">Menu Icon</label>
            <input type="file" class="form-control" id="inputMenuIconEdit" name="inputMenuIconEdit" placeholder="Choose file">
          </div>
          <div class="form-group">
            <label for="inputMenuUrlEdit">URL</label>
            <input type="link" class="form-control" id="inputMenuUrlEdit" name="inputMenuUrlEdit" placeholder="Enter URL">
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
            <h6 class="m-0 font-weight-bold text-primary">Social Media
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmenu">
                    Add Social Media
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Text</th>
                            <th>Icon</th>
                            <th>URL</th>
                            <th>Type</th>
                            <th>Admin</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['title']?></td>
                            <td><?php echo $row['text']?></td>
                            <td><?php echo $row['icon']?></td>
                            <td><?php echo $row['url']?></td>
                            <td><?php echo $row['type_']?></td>
                            <td><?php echo $row['name']?></td>
                            <td>
                            <input 
                            type="button" 
                            name="edit" 
                            value="Edit" 
                            id="<?php echo $row["menu_id"]; ?>" 
                            class="btn btn-secondary btn-xs edit_data" />
                              <a 
                              href="CRUD/menu/menuDelete.php/?delete=<?php echo $row["menu_id"];?>" 
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
  $('#id_hidden').val(id);  
  $.ajax({
    url: 'CRUD/menu/getInfo.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      $('#updaterow').modal('show');
      newdata = JSON.parse(data);
      // alert(data);
      $('#inputMenuTypeEdit').val(newdata.menuType);
      $('#inputMenuTitleEdit').val(newdata.menuTitle);
      $('#inputMenuTextEdit').val(newdata.menuText);
      $('#inputMenuIconEdit').val(newdata.menuIcon);
      $('#inputMenuUrlEdit').val(newdata.menuURL);
  }
  });
});
</script>