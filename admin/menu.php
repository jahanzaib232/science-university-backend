<?php 
include('includes/header.php');
include('includes/navbar.php');

require_once 'database.php';


$sql = "SELECT menu.menu_id, menu.text, menu.icon, menu.url, menu.parent, menu.type, user.name
FROM db_science_university_menu as menu JOIN db_science_university_users as user
WHERE user.id = menu.db_science_university_users_id";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);

?>
<div class="modal fade" id="addmenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Menu Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/menu/menuInsert.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputMenuType">Type (Footer, Header, Social Media)</label>
            <select class="form-control" id="inputMenuType" name="inputMenuType">
              <option value="footer">Footer</option>
              <option value="header">Header</option>
              <option value="social media">Social Media</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputMenuText">Text</label>
            <input type="text" class="form-control" id="inputMenuText" name="inputMenuText" placeholder="Enter text" required>
          </div>
          <div class="form-group">
            <label for="inputMenuIcon">Menu Icon</label>
            <input type="file" class="form-control" id="inputMenuIcon" name="inputMenuIcon" placeholder="Choose file" required>
          </div>
          <div class="form-group">
            <label for="inputMenuUrl">URL</label>
            <input type="link" class="form-control" id="inputMenuUrl" name="inputMenuUrl" placeholder="Enter URL" required>
          </div>
          <div class="form-group">
            <label for="inputMenuParent">Parent</label>
            <input type="text" class="form-control" id="inputMenuParent" name="inputMenuParent" placeholder="Select Parent" required>
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
            <h6 class="m-0 font-weight-bold text-primary">Menu
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmenu">
                    Add Menu
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Text</th>
                            <th>Icon</th>
                            <th>URL</th>
                            <th>Parent</th>
                            <th>Type (Footer, Header, Social Media)</th>
                            <th>Admin</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['text']?></td>
                            <td><?php echo $row['icon']?></td>
                            <td><?php echo $row['url']?></td>
                            <td><?php echo $row['parent']?></td>
                            <td><?php echo $row['type']?></td>
                            <td><?php echo $row['name']?></td>
                            <td>
                              <a 
                              href="CRUD/menu/menuUpdate.php/?edit=<?php echo $row["menu_id"];?>" 
                              class="btn btn-secondary">Edit</a>
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