<html>
	<!-- Task Assignment Calender with Event Management -->
	<!-- By Sainath Sapa, info.djsai@gmail.com -->

<head>
	<title>Calender with Events</title>
	<link rel="stylesheet" href="assets/style/bootstrap.css" />
	<link rel="stylesheet" href="assets/style/styles.css" />
	<?php
	require('db.php');
	?>


</head>

<body>
	<?php
	//gettings servers date and month
	$current_date = date("d");
	$current_month = date("m");



	$year = 2021; // input current year
	if (strlen($year) != 4) {
		$year = date('Y'); // Current Year is taken if year is not set in above line. 
	}


	$row = 4;  // Row NUmber as per required design
	$row_no = 0; // 
	echo "<table class='container '>";
	echo "<center><h1 class='head'>2021</h1>";
	echo "<b>Task by Sainath Sapa</b><i> info.djsai@gmail.com</i></center>";
	// Loop for 12 months for a year
	for ($m = 1; $m <= 12; $m++) {
		$month = date($m);
		$dateObject = DateTime::createFromFormat('!m', $m);
		$monthName = $dateObject->format('F');
		$d = 2;
		$no_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year); // inbuild function

		$j = date('w', mktime(0, 0, 0, $month, 1, $year)); //calculate the week and day

		$j = $j - 1;
		if ($j < 0) {
			$j = 6;
		}

		//display_blank
		$blank = str_repeat("<td ></td>", $j);
		$blank_at_end = 42 - $j - $no_of_days;
		if ($blank_at_end >= 7) {
			$blank_at_end = $blank_at_end - 7;
		}
		$blank2 = str_repeat("<td></td>", $blank_at_end); // Blank ending cells of the calendar

		if (($row_no % $row) == 0) {
			echo "</tr><tr>";
		}
		// display month name
		echo "<td><table class='main'><td colspan=7 align=center> $monthName 


 </td></tr>";
		// display weeks	
		echo "<tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr><tr>";

		// Printing dates and days
		for ($i = 1; $i <= $no_of_days; $i++) {
			$pv = $i . '-' . $month . '-' . $year;
			

			// fetching futures dates
			$selectevent = "SELECT * FROM events WHERE `ev_date`='$pv'";
			$runQry = $connection->query($selectevent);
			$fetchedRow = $runQry->fetch_assoc();



			//current month logic
			if ($current_month == $month) {
				if ($i < date('d')) {
					//for past days in current month
					echo $blank . "<td class='grey text-white'><span data-toggle='modal' data-target='#EventAdd' onclick=assign_val(`$pv`);>$i</span>";
				} elseif ($i == $current_date) {
					// for current date in month
					echo $blank . "<td class='current'><span data-toggle='modal' data-target='#EventAdd' onclick=assign_val(`$pv`);>$i</span>";
				} elseif ($pv == $fetchedRow['ev_date']) {
					// events in current month
					echo $blank . "<td class='blue'><span data-toggle='modal' data-target='#EventAdd' onclick=assign_val(`$pv`);>$i</span>";
				} else
				// if no events print only date
					echo $blank . "<td ><span data-toggle='modal' data-target='#EventAdd' onclick=assign_val(`$pv`);>$i</span>";
			}

			//past month logic
			if ($month < $current_month) {

				echo $blank . "<td class='grey text-white'><span data-toggle='modal' data-target='#EventAdd' onclick=assign_val(`$pv`);>$i</span>";
			}
			// future month logic
			if ($month > $current_month) {


				if ($pv == $fetchedRow['ev_date']) {
					// if future month having event
					echo $blank . "<td class='blue'><span data-toggle='modal' data-target='#EventAdd' onclick=assign_val(`$pv`);>$i</span>";
				} else
					echo $blank . "<td ><span data-toggle='modal' data-target='#EventAdd' onclick=assign_val(`$pv`);>$i</span>";
			}



//next row of week
			echo " </td>";
			$blank = ''; //resign empty blank
			$j++;
			if ($j == 7) {
				echo "</tr><tr>";
				$j = 0;
			}
		}
		echo $blank2;
		echo "</tr></table></td>";

		$row_no += 1;
	} // end
	echo "</table>";
	?>

</body>



<?php
require('form.php'); //pop-ups
?>

<!-- javascript libs -->
<script src="assets/js/jquery-3.5.1.min.js"></script>

<script src="assets/js/bootstrap.js"></script>
<!-- End of Code -->
</html>