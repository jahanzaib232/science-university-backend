<?php 
include('includes/header.php');
include('includes/navbar.php');

require_once 'database.php';


$sql = "SELECT ticker.ticker_id, ticker.icon_image, ticker.number_, ticker.character_before_number, ticker.character_, ticker.data_target, ticker.inc_or_decr, ticker.description_, user.name
FROM db_science_university_ticker as ticker JOIN db_science_university_users as user
WHERE user.id = ticker.db_science_university_users_id";
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

<div class="modal fade" id="addticker" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ticker Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/ticker/tickerInsert.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputIconImage">Icon Image</label>
            <input type="file" class="form-control" id="inputIconImage" name="inputIconImage"  required>
          </div>
          <div class="form-group">
            <label for="inputTickerNumber">Number</label>
            <input type="text" class="form-control" id="inputTickerNumber" name="inputTickerNumber" placeholder="Enter Ticker Number"  >
          </div>
          <div class="form-group">
            <label for="inputDataTarget">Data Target</label>
            <input type="text" class="form-control" id="inputDataTarget" name="inputDataTarget" placeholder="Enter Data Target"  >
          </div>
          <div class="form-group">
            <label for="inputTickerCharacter">Character</label>
            <input type="text" class="form-control" id="inputTickerCharacter" name="inputTickerCharacter" placeholder="Enter Character">
          </div>
          <div class="form-group">
            <label for="inputCharacterBeforeNum">Character Before Number</label>
            <input type="checkbox" id="inputCharacterBeforeNum" name="inputCharacterBeforeNum" value='1'>
          </div>
          <div class="form-group">
            <label>Counter<br>
            <input type="radio" id="inputTickerCount" name="inputTickerCount" value="Increment"  >
            <label for="inputTickerCount">Increment</label>
                  
            <input type="radio" id="inputTickerCount" name="inputTickerCount" value="Decrement"  >
            <label for="inputTickerCount">Decrement</label>
            </label>
          </div>
          <div class="form-group">
              <label for="inputTickerDescription">Description</label>
              <input type="text" class="form-control" id="inputTickerDescription" name="inputTickerDescription" placeholder="Enter Description"  >
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
        <h5 class="modal-title" id="exampleModalLongTitle">Ticker Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/ticker/tickerUpdate.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputIconImageEdit">Icon Image</label>
            <input type="file" class="form-control" id="inputIconImageEdit" name="inputIconImageEdit"  required>
          </div>
          <div class="form-group">
            <label for="inputTickerNumberEdit">Number</label>
            <input type="text" class="form-control" id="inputTickerNumberEdit" name="inputTickerNumberEdit" >
          </div>
          <div class="form-group">
            <label for="inputDataTargetEdit">Data Target</label>
            <input type="text" class="form-control" id="inputDataTargetEdit" name="inputDataTargetEdit" >
          </div>
          <div class="form-group">
            <label for="inputTickerCharacterEdit">Character</label>
            <input type="text" class="form-control" id="inputTickerCharacterEdit" name="inputTickerCharacterEdit" >
          </div>
          <div class="form-group">
            <label for="inputCharacterBeforeNumEdit">Character Before Number</label>
            <input type="checkbox" id="inputCharacterBeforeNumEdit" name="inputCharacterBeforeNumEdit" value='1'>
          </div>
          <div class="form-group">
            <label>Counter<br>
            <input type="radio" id="inputTickerCountEdit" name="inputTickerCountEdit" value="Increment"  >
            <label for="inputTickerCountEdit">Increment</label>
                  
            <input type="radio" id="inputTickerCountEdit" name="inputTickerCountEdit" value="Decrement"  >
            <label for="inputTickerCountEdit">Decrement</label>
            </label>
          </div>
          <div class="form-group">
              <label for="inputTickerDescriptionEdit">Description</label>
              <input type="text" class="form-control" id="inputTickerDescriptionEdit" name="inputTickerDescriptionEdit" placeholder="Enter Description"  >
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
            <h6 class="m-0 font-weight-bold text-primary">Ticker
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addticker">
                    Add Ticker
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Icon Image</th>
                            <th>Ticker Start Number</th>
                            <th>Target</th>
                            <th>Character</th>
                            <th>Character Before Number</th>
                            <th>Counter</th>
                            <th>Description</th>
                            <th>Admin</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['icon_image'];?></td>
                            <td><?php echo $row['number_'];?></td>
                            <td><?php echo $row['data_target'];?></td>
                            <td><?php echo $row['character_'];?></td>
                            <td><?php echo $row['character_before_number'];?></td>
                            <td><?php echo $row['inc_or_decr'];?></td>
                            <td><?php echo $row['description_'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                            <input 
                            type="button" 
                            name="edit" 
                            value="Edit" 
                            id="<?php echo $row["ticker_id"]; ?>" 
                            class="btn btn-secondary btn-xs edit_data" />
                              <a 
                              href="CRUD/ticker/tickerDelete.php/?delete=<?php echo $row['ticker_id']; ?>" 
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
include('includes/footer.php');?>

<script>

$(document).on('click', '.edit_data', function(){
  var id = $(this).attr('id');
  $('#id_hidden').val(id);  
  $.ajax({
    url: 'CRUD/ticker/getInfo.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      newdata = JSON.parse(data);
      
      $('#updaterow').modal('show');
      $('#inputIconImageEdit').text(newdata.tickerImage);
      $('#inputTickerNumberEdit').val(newdata.tickerNumber);
      $('#inputTickerCharacterEdit').val(newdata.tickerCharacter);
      $('#inputCharacterBeforeNumEdit').val(newdata.tickerCharBeforeNum);
      $('#inputDataTargetEdit').val(newdata.tickerTarget);
      $('#inputTickerCountEdit').val(newdata.tickerCount);
      $('#inputTickerDescriptionEdit').val(newdata.tickerDescription);
    }
  });
});
</script>