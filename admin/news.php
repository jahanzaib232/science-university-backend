<?php 
include('includes/header.php');
include('includes/navbar.php');

require_once 'database.php';


$sql = "SELECT news.id, news.news_title, news.news_link, news.news_description, news.news_date, news_cat.category_name, news.is_active, user.name
FROM db_science_university_news as news JOIN db_science_university_users as user JOIN news_category as news_cat
WHERE user.id = news.db_science_university_user_id AND news_cat.category_id = news.news_category_category_id";
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
        <form method="POST" action="CRUD/news/newsInsert.php">
          <div class="form-group">
            <label for="inputNewsTitle">News Title</label>
            <input type="text" class="form-control" id="inputNewsTitle" name="inputNewsTitle" placeholder="Enter title"  >
          </div>
          <div class="form-group">
            <label for="inputNewsLink">News Link</label>
            <input type="link" class="form-control" id="inputNewsLink" name="inputNewsLink" placeholder="Enter title"  >
          </div>
          <div class="form-group">
            <label for="inputNewsCategory">News Category</label>
            <select name="newsCategories" class="form-control">
            <?php 
            $newsCatSql = "SELECT category_id, category_name FROM news_category";
            $newsSqlResult = $conn->query($newsCatSql);
            while($row = $newsSqlResult->fetch()):?>
              <option  value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
            <?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label for="inputNewsDescription">News description</label>
            <textarea class="form-control" id="inputNewsDescription" name="inputNewsDescription" placeholder="Enter description"  ></textarea>
          </div>
          <div class="form-group">
            <label for="inputNewsDate">News Date</label>
            <input type="date" class="form-control" id="inputNewsDate" name="inputNewsDate"  >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputNewsActive" name="inputNewsActive" value="1" >
            <label for="inputNewsActive">Yes</label>
                  
            <input type="radio" id="inputNewsActive" name="inputNewsActive" value="0" >
            <label for="inputNewsActive">No</label>
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
        <h5 class="modal-title" id="exampleModalLongTitle">News Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/news/newsUpdate.php">
          <div class="form-group">
            <label for="inputNewsTitleEdit">News Title</label>
            <input type="text" class="form-control" id="inputNewsTitleEdit" name="inputNewsTitleEdit" placeholder="Enter title"  >
          </div>
          <div class="form-group">
            <label for="inputNewsLinkEdit">News Link</label>
            <input type="link" class="form-control" id="inputNewsLinkEdit" name="inputNewsLinkEdit" placeholder="Enter title"  >
          </div>
          <div class="form-group">
            <label for="newsCategoriesEdit">News Category</label>
            <select name="newsCategoriesEdit" class="form-control">
            <?php 
            $newsCatSql = "SELECT category_id, category_name FROM news_category";
            $newsSqlResult = $conn->query($newsCatSql);
            while($row = $newsSqlResult->fetch()):?>
              <option value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
            <?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label for="inputNewsDescriptionEdit">News description</label>
            <textarea class="form-control" id="inputNewsDescriptionEdit" name="inputNewsDescriptionEdit" placeholder="Enter description"  ></textarea>
          </div>
          <div class="form-group">
            <label for="inputNewsDateEdit">News Date</label>
            <input type="date" class="form-control" id="inputNewsDateEdit" name="inputNewsDateEdit"  >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputNewsActiveEdit_1" name="inputNewsActiveEdit" >
            <label for="inputNewsActiveEdit_1">Yes</label>
                  
            <input type="radio" id="inputNewsActiveEdit_0" name="inputNewsActiveEdit" >
            <label for="inputNewsActiveEdit_0">No</label>
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
            <h6 class="m-0 font-weight-bold text-primary">News
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addnews">
                    Add News
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>News Title</th>
                            <th>News Category</th>
                            <th>News Link</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Is Active</th>
                            <th>Added by Admin</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['news_title']?></td>
                            <td><?php echo $row['category_name']?></td>
                            <td><?php echo $row['news_link']?></td>
                            <td><?php echo $row['news_description']?></td>
                            <td><?php echo $row['news_date']?></td>
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
                                href="CRUD/news/newsDelete.php/?delete=<?php echo $row["id"];?>" 
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
    url: 'CRUD/news/getInfo.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      newdata = JSON.parse(data);
      $('#updaterow').modal('show');
      $('#inputNewsTitleEdit').val(newdata.newsTitle);
      $('#inputNewsLinkEdit').val(newdata.newsLink);
      $('#inputNewsDescriptionEdit').val(newdata.newsDescription);
      $('#inputNewsDateEdit').val(newdata.newsDate);
      $('#newsCategoriesEdit').val(newdata.catName);

      $('#inputNewsActiveEdit_1').val(newdata.newsActive);
      $('#inputNewsActiveEdit_0').val(newdata.newsActive);
      if(newdata.newsActive == 1){
        $('#inputNewsActiveEdit_1').prop('checked', true);
      } else {
        $('#inputNewsActiveEdit_0').prop('checked', true);

      }
  }
  });
});
</script>