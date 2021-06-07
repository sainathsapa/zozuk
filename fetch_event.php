<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Event</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>


        </tr>
    </thead>
    <tbody>
        <?php
        require('db.php');
        $date = $_GET['date'];
        $selectQry = "SELECT * FROM events WHERE `ev_date`='$date'";
        $runQry = $connection->query($selectQry);
        $count = 1;
        while ($row = $runQry->fetch_assoc()) {
        ?>
            <tr>


                <th scope="row"><?php echo $count++; ?></th>
                <td><?php echo $row['event'];?></td>
                <td><?php echo $row['ev_date'];?></td>
                <td><?php echo $row['time'];?></td>

            </tr>
        <?php } ?>
    </tbody>
</table>