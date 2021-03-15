<?php 
require_once("includes/dbConnect.php");
//	$count = '0';
//	$usertable = 'Reminder';
//	while ($count < '3000'){
//		$nrCurrentTime = round(microtime(true) * 10000);
//		$query = "INSERT INTO $usertable (UID, RID, Title, Content, Display, Complete, Priority, Status) VALUES ('$count', '$nrCurrentTime', 'Test', 'Part', 'TestPart', '$nrCurrentTime', '2', '1')";
//		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
//		echo "$count ";
//		$count++;
//	}

	$query = "DELETE FROM $usertable WHERE Display = 'TestPart'";
	$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));



	?>
	
	