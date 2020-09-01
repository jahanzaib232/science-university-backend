<?php 
include('includes/header.php');
include('includes/navbar.php');

require_once 'database.php';


$sql = "SELECT news.news_title, news.news_description, news.news_date, news_cat.category_name, user.name
FROM db_science_university_news as news JOIN db_science_university_users as user JOIN news_category as news_cat
WHERE user.id = news.db_science_university_user_id AND news_cat.category_id = news.news_category_category_id";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
?>
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
            <input type="text" class="form-control" id="inputNewsTitle" name="inputNewsTitle" placeholder="Enter title" required>
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
            <textarea class="form-control" id="inputNewsDescription" name="inputNewsDescription" placeholder="Enter description" required></textarea>
          </div>
          <div class="form-group">
            <label for="inputNewsDate">News Date</label>
            <input type="date" class="form-control" id="inputNewsDate" name="inputNewsDate" required>
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
                            <th>Description</th>
                            <th>Date</th>
                            <th>Added by Admin</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['news_title']?></td>
                            <td><?php echo $row['category_name']?></td>
                            <td><?php echo $row['news_description']?></td>
                            <td><?php echo $row['news_date']?></td>
                            <td><?php echo $row['name']?></td>
                            <td>
                                <a href="" class="btn btn-secondary">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
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