<?php
// Initialize the session
session_start();

//log action	
include("../includes/dbConnect.php");
$uid= $_SESSION['UID'];
$remote = $_SERVER['REMOTE_ADDR'];
$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
$page = 'logout';
$message = "User logged out.";
$timestamp =  time();
$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('$uid', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
?>
<script type="text/javascript">
	window.location.replace("https://reeemind.com/ajax/dashboard.php");
</script>
<?php
exit;
?>