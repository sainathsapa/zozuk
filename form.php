<div class="modal fade" id="EventAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">

          <div class="form-group">
            <label for="event" class="col-form-label">Event:</label>
            <input type="text" class="form-control" name="event" required>
          </div>

          <div class="form-group">
            <label for="date" class="col-form-label">Date:</label>
            <input type="text" class="form-control" name="date_event" id="date_eve" required>
          </div>

          <div class="form-group">
            <label for="time" class="col-form-label">Time:</label>
            <input type="time" class="form-control" name="time" required>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>




      </div>
      <center>
        <button type="button" class="btn btn-info" onclick='$("#d").load("fetch_event.php","date="+$("#date_eve").val());'>
          View Events

        </button>
      </center>
      <div id='d'>
      </div>


    </div>
  </div>
</div>
<!-- Function to assign values on date -->
<script>
  function assign_val(pv) {
    $("#date_eve").val(pv);

  }
</script>
<?php
if (isset($_POST['submit'])) {
  $event = $_POST['event'];
  $date = $_POST['date_event'];
  $time = $_POST['time'];

  $insertQuery = "INSERT INTO events (`event`,`ev_date`,`time`) VALUES('$event','$date','$time')";
  $runQuery = $connection->query($insertQuery);
  if ($runQuery) {
    echo "<script>alert('event added');</script>";
  }
}
