<?php
	session_start();
	include("../includes/dbConnect.php");
	$uid= $_SESSION['UID'];
	$selected = $_POST['value']; 
		
	foreach ($selected as $key => $value) {
		//log action	
		$remote = $_SERVER['REMOTE_ADDR'];
		$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$page = 'deleteEntry';
		$message = "Record Deleted. RID = $value";
		$timestamp =  time();
		$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('$uid', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
		//delete
		$query = "Delete FROM Reminder WHERE (RID = '$value')";
		$result = mysqli_query($conn, $query) or die ("Error querying database." . mysqli_error($conn));
		}
		$key++;
?>
<script>
	$.post('rTable.php', result);
			function result(data){
				$('#d2').html(data);
		};
</script>