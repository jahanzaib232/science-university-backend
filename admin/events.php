<?php 
include('includes/header.php');
include('includes/navbar.php');
require_once 'database.php';


$sql = "SELECT events.id, events.event_title, events.event_description, events.event_icon, events.event_date, events.event_start_time, events.event_end_time, events.event_location, events_cat.category_name, user.name
FROM db_science_university_events as events JOIN db_science_university_users as user JOIN events_category as events_cat
WHERE user.id = events.db_science_university_users_id AND events_cat.category_id = events.event_category_category_id";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
?>
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
            <input type="text" class="form-control" id="inputEventTitle" name="inputEventTitle" placeholder="Enter title" required>
          </div>
          <div class="form-group">
            <label for="inputEventsCategory">Events Category</label>
            <select name="eventsCategories" class="form-control">
            <?php 
            $eventsCatSql = "SELECT category_id, category_name FROM events_category";
            $eventsSqlResult = $conn->query($eventsCatSql);
            while($row = $eventsSqlResult->fetch()):?>
              <option  value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
            <?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label for="inputEventDescription">Event Description</label>
            <textarea class="form-control" id="inputEventDescription" name="inputEventDescription" placeholder="Enter Description" required></textarea>
          </div>
          <div class="form-group">
              <label for="inputEventIcon">Event Icon</label>
              <input type="file" class="form-control" id="inputEventIcon" name="inputEventIcon" placeholder="Choose file" required>
          </div>
          <div class="form-group">
              <label for="inputEventDate">Event date</label>
              <input type="date" class="form-control" id="inputEventDate" name="inputEventDate" placeholder="Choose file" required>
          </div>
          <div class="form-group">
              <label for="inputEventStartTime">Event start time</label>
              <input type="time" class="form-control" id="inputEventStartTime" name="inputEventStartTime" required>
          </div>
          <div class="form-group">
              <label for="inputEventEndTime">Event end time</label>
              <input type="time" class="form-control" id="inputEventEndTime" name="inputEventEndTime" required>
          </div>
          <div class="form-group">
              <label for="inputEventLocation">Event location</label>
              <input type="text" class="form-control" id="inputEventLocation" name="inputEventLocation" required>
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
            <input type="text" class="form-control" id="inputEventTitleEdit" name="inputEventTitleEdit" placeholder="Enter title" required>
          </div>
          <div class="form-group">
            <label for="inputEventsCategory">Events Category</label>
            <select name="eventsCategoriesEdit" class="form-control">
            <?php 
            $eventsCatSql = "SELECT category_id, category_name FROM events_category";
            $eventsSqlResult = $conn->query($eventsCatSql);
            while($row = $eventsSqlResult->fetch()):?>
              <option  value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
            <?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label for="inputEventDescriptionEdit">Event Description</label>
            <textarea class="form-control" id="inputEventDescriptionEdit" name="inputEventDescriptionEdit" placeholder="Enter Description" required></textarea>
          </div>
          <div class="form-group">
              <label for="inputEventIconEdit">Event Icon</label>
              <input type="file" class="form-control" id="inputEventIconEdit" name="inputEventIconEdit" placeholder="Choose file" required>
          </div>
          <div class="form-group">
              <label for="inputEventDateEdit">Event date</label>
              <input type="date" class="form-control" id="inputEventDateEdit" name="inputEventDateEdit" placeholder="Choose file" required>
          </div>
          <div class="form-group">
              <label for="inputEventStartTimeEdit">Event start time</label>
              <input type="time" class="form-control" id="inputEventStartTimeEdit" name="inputEventStartTimeEdit" required>
          </div>
          <div class="form-group">
              <label for="inputEventEndTimeEdit">Event end time</label>
              <input type="time" class="form-control" id="inputEventEndTimeEdit" name="inputEventEndTimeEdit" required>
          </div>
          <div class="form-group">
              <label for="inputEventLocationEdit">Event location</label>
              <input type="text" class="form-control" id="inputEventLocationEdit" name="inputEventLocationEdit" required>
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
                            <th>Event Icon</th>
                            <th>Event Date</th>
                            <th>Event start time</th>
                            <th>Event end time</th>
                            <th>Event location</th>
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
                            <td><?php echo $row['event_icon'];?></td>
                            <td><?php echo $row['event_date'];?></td>
                            <td><?php echo $row['event_start_time'];?></td>
                            <td><?php echo $row['event_end_time'];?></td>
                            <td><?php echo $row['event_location'];?></td>
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
  $.ajax({
    url: 'CRUD/events/eventsUpdate.php',
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