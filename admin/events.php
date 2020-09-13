<?php 
include('includes/header.php');
include('includes/navbar.php');
require_once 'database.php';


$sql = "SELECT events.id, events.event_title, events.event_description, events.event_image, events.event_date, events.event_start_time, events.event_end_time, events.event_location, events_cat.category_name, events.is_active, user.name
FROM db_science_university_events as events JOIN db_science_university_users as user JOIN events_category as events_cat
WHERE user.id = events.db_science_university_users_id AND events_cat.category_id = events.event_category_category_id";
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

<div class="modal fade" id="addevent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Event Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/events/eventsInsert.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputEventTitle">Event Title</label>
            <input type="text" class="form-control" id="inputEventTitle" name="inputEventTitle" placeholder="Enter title" >
          </div>
          <div class="form-group">
            <label for="inputEventsCategory">Events Category</label>
            <select id="eventsCategories" name="eventsCategories" class="form-control">
            <?php 
            $eventsCatSql = "SELECT category_id, category_name FROM events_category";
            $eventsSqlResult = $conn->query($eventsCatSql);
            while($row = $eventsSqlResult->fetch()):?>
              <option value="<?php echo $row['category_id'];?>" selected><?php echo $row['category_name'];?></option>
            <?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label for="inputEventDescription">Event Description</label>
            <textarea class="form-control" id="inputEventDescription" name="inputEventDescription" placeholder="Enter Description" ></textarea>
          </div>
          <div class="form-group">
              <label for="inputEventIcon">Event Image</label>
              <input type="file" class="form-control" id="inputEventIcon" name="inputEventIcon" placeholder="Choose file" required>
          </div>
          <div class="form-group">
              <label for="inputEventDate">Event date</label>
              <input type="date" class="form-control" id="inputEventDate" name="inputEventDate" placeholder="Choose file" >
          </div>
          <div class="form-group">
              <label for="inputEventStartTime">Event start time</label>
              <input type="time" class="form-control" id="inputEventStartTime" name="inputEventStartTime" >
          </div>
          <div class="form-group">
              <label for="inputEventEndTime">Event end time</label>
              <input type="time" class="form-control" id="inputEventEndTime" name="inputEventEndTime" >
          </div>
          <div class="form-group">
              <label for="inputEventLocation">Event location</label>
              <input type="text" class="form-control" id="inputEventLocation" name="inputEventLocation" >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputEventsActive" name="inputEventsActive" value="1" >
            <label for="inputEventsActive">Yes</label>
                  
            <input type="radio" id="inputEventsActive" name="inputEventsActive" value="0" >
            <label for="inputEventsActive">No</label>

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
        <h5 class="modal-title" id="exampleModalLongTitle">Events Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="CRUD/events/eventsUpdate.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="inputEventTitleEdit">Event Title</label>
            <input type="text" class="form-control" id="inputEventTitleEdit" name="inputEventTitleEdit" placeholder="Enter title" >
          </div>
          <div class="form-group">
            <label for="inputEventsCategory">Events Category</label>
            <select id="eventsCategoriesEdit" name="eventsCategoriesEdit" id="eventsCategoriesEdit" class="form-control">
            <?php 
            $eventsCatSql = "SELECT category_id, category_name FROM events_category";
            $eventsSqlResult = $conn->query($eventsCatSql);
            while($row = $eventsSqlResult->fetch()):?>
              <option value="<?php echo $row['category_id'];?>" selected><?php echo $row['category_name'];?></option>
            <?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label for="inputEventDescriptionEdit">Event Description</label>
            <textarea class="form-control" id="inputEventDescriptionEdit" name="inputEventDescriptionEdit" placeholder="Enter Description" ></textarea>
          </div>
          <div class="form-group">
              <label for="inputEventIconEdit">Event Image</label>
              <input type="file" class="form-control" id="inputEventIconEdit" name="inputEventIconEdit" placeholder="Choose file" required>
          </div>
          <div class="form-group">
              <label for="inputEventDateEdit">Event date</label>
              <input type="date" class="form-control" id="inputEventDateEdit" name="inputEventDateEdit" placeholder="Choose file" >
          </div>
          <div class="form-group">
              <label for="inputEventStartTimeEdit">Event start time</label>
              <input type="time" class="form-control" id="inputEventStartTimeEdit" name="inputEventStartTimeEdit" >
          </div>
          <div class="form-group">
              <label for="inputEventEndTimeEdit">Event end time</label>
              <input type="time" class="form-control" id="inputEventEndTimeEdit" name="inputEventEndTimeEdit" >
          </div>
          <div class="form-group">
              <label for="inputEventLocationEdit">Event location</label>
              <input type="text" class="form-control" id="inputEventLocationEdit" name="inputEventLocationEdit" >
          </div>
          <div class="form-group">
            <label>Is Active<br>
            <input type="radio" id="inputEventsActive_1" name="inputEventsActiveEdit" value="1" >
            <label for="inputEventsActive_1">Yes</label>
                  
            <input type="radio" id="inputEventsActive_0" name="inputEventsActiveEdit" value="0" >
            <label for="inputEventsActive_0">No</label>
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
            <h6 class="m-0 font-weight-bold text-primary">Event
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addevent">
                    Add Event
                </button>
            </h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Event Title</th>
                            <th>Event Category</th>
                            <th>Description</th>
                            <th>Event Image</th>
                            <th>Event Date</th>
                            <th>Event start time</th>
                            <th>Event end time</th>
                            <th>Event location</th>
                            <th>Is Active</th>
                            <th>Admin</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php while($row = $result->fetch()):?>
                        <tr>
                            <td><?php echo $row['event_title'];?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['event_description'];?></td>
                            <td><?php echo $row['event_image'];?></td>
                            <td><?php echo $row['event_date'];?></td>
                            <td><?php echo $row['event_start_time'];?></td>
                            <td><?php echo $row['event_end_time'];?></td>
                            <td><?php echo $row['event_location'];?></td>
                            <td><?php echo $row['is_active'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                            <input 
                            type="button" 
                            name="edit" 
                            value="Edit" 
                            id="<?php echo $row["id"]; ?>" 
                            class="btn btn-secondary btn-xs edit_data" />
                              <a 
                              href="CRUD/events/eventsDelete.php/?delete=<?php echo $row['id'];?>" 
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
    url: 'CRUD/events/getInfo.php',
    method: "POST",
    data:{id:id}, 
    success: function(data) {
      newdata = JSON.parse(data);
      $('#updaterow').modal('show');
    
      $('#inputEventsActive_1').val(newdata.eventsActive);
      $('#inputEventsActive_0').val(newdata.eventsActive);
      if(newdata.eventsActive == 1){
        $('#inputEventsActive_1').prop('checked', true);
      } else {
        $('#inputEventsActive_0').prop('checked', true);
      }
      $('#inputEventTitleEdit').val(newdata.eventTitle);
      $('#eventsCategoriesEdit').val(newdata.catName);
      $('#inputEventDescriptionEdit').val(newdata.eventDescription);
      $('#inputEventIconEdit').val(newdata.eventImage);
      $('#inputEventDateEdit').val(newdata.eventDate);
      $('#inputEventStartTimeEdit').val(newdata.eventStartTime);
      $('#inputEventEndTimeEdit').val(newdata.eventEndTime);
      $('#inputEventLocationEdit').val(newdata.eventLocation);
    }
  });
});
</script>