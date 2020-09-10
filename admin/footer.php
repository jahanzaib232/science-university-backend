<?php 
include('includes/header.php');
include('includes/navbar.php');

require_once 'database.php';


$sql = "SELECT footer.footer_id, footer.parent_title, footer.item_list, footer.item_link, footer.item_icon, footer.image_, footer.is_active, user.name
FROM db_science_university_footer as footer JOIN db_science_university_users as user
WHERE user.id = footer.db_science_university_users_id";
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
        <h5 class="modal-title" id="exampleModalLongTitle">Footer Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/footer/footerInsert.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputParentTitle">Parent Title</label>
            <input type="text" class="form-control" id="inputParentTitle" name="inputParentTitle" placeholder="Enter text" >
          </div>
          <div class="form-group">
            <label for="inputItemList">Item List</label>
            <input type="text" class="form-control" id="inputItemList" name="inputItemList" placeholder="Enter text" >
          </div>
          <div class="form-group">
            <label for="inputItemIcon">Item Icon</label>
            <input type="text" class="form-control" id="inputItemIcon" name="inputItemIcon" placeholder="Enter text" >
          </div>
          <div class="form-group">
            <label for="inputItemLink">Item Link</label>
            <input type="text" class="form-control" id="inputItemLink" name="inputItemLink" placeholder="Enter text" >
          </div>
          <div class="form-group">
            <label for="inputFooterImage">Image</label>
            <input type="file" class="form-control" id="inputFooterImage" name="inputFooterImage" placeholder="Choose file">
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputFooterActive" name="inputFooterActive" value="1">
            <label for="inputFooterActive">Yes</label>
                  
            <input type="radio" id="inputFooterActive" name="inputFooterActive" value="0">
            <label for="inputFooterActive">No</label>
            </label>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Footer Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/footer/footerUpdate.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputParentTitleEdit">Parent Title</label>
            <input type="text" class="form-control" id="inputParentTitleEdit" name="inputParentTitleEdit" placeholder="Enter text" >
          </div>
          <div class="form-group">
            <label for="inputItemListEdit">Item List</label>
            <input type="text" class="form-control" id="inputItemListEdit" name="inputItemListEdit" placeholder="Enter text" >
          </div>
          <div class="form-group">
            <label for="inputItemIconEdit">Item Icon</label>
            <input type="text" class="form-control" id="inputItemIconEdit" name="inputItemIconEdit" placeholder="Enter text" >
          </div>
          <div class="form-group">
            <label for="inputItemLinkEdit">Item Link</label>
            <input type="text" class="form-control" id="inputItemLinkEdit" name="inputItemLinkEdit" placeholder="Enter Link" >
          </div>
          <div class="form-group">
            <label for="inputFooterImageEdit">Image</label>
            <input type="file" class="form-control" id="inputFooterImageEdit" name="inputFooterImageEdit" placeholder="Choose file">
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputFooterActiveEdit" name="inputFooterActiveEdit" value="1">
            <label for="inputFooterActiveEdit">Yes</label>
                  
            <input type="radio" id="inputFooterActiveEdit" name="inputFooterActiveEdit" value="0">
            <label for="inputFooterActiveEdit">No</label>
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
            <h6 class="m-0 font-weight-bold text-primary">Footer
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmenu">
                    Add Footer
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Parent Title</th>
                            <th>Item List</th>
                            <th>List Link</th>
                            <th>List Icon</th>
                            <th>Image</th>
                            <th>Is Active</th>
                            <th>Admin</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['parent_title']?></td>
                            <td><?php echo $row['item_list']?></td>
                            <td><?php echo $row['item_link']?></td>
                            <td><?php echo $row['item_icon']?></td>
                            <td><?php echo $row['image_']?></td>
                            <td><?php echo $row['is_active']?></td>
                            <td><?php echo $row['name']?></td>
                            <td>
                            <input 
                            type="button" 
                            name="edit" 
                            value="Edit" 
                            id="<?php echo $row["footer_id"]; ?>" 
                            class="btn btn-secondary btn-xs edit_data" />
                              <a 
                              href="CRUD/footer/footerDelete.php/?delete=<?php echo $row["footer_id"];?>" 
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
    url: 'CRUD/footer/getInfo.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      $('#updaterow').modal('show');
      newdata = JSON.parse(data);
      $('#inputParentTitleEdit').val(newdata.parentTitle);
      $('#inputItemListEdit').val(newdata.itemList);
      $('#inputItemLinkEdit').val(newdata.itemLink);
      $('#inputItemIconEdit').val(newdata.itemIcon);
      $('#inputFooterImageEdit').val(newdata.image);
      $('#inputFooterActiveEdit').val(newdata.isActive);

  }
  });
});
</script>