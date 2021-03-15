<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<?php
//Initialize the session
session_start();
 
//Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login.php");
    exit;
}
//Variable Defenition
include("../includes/dbConnect.php");
include("../../etc/reeemind.com/tax/taxes.php");
$uid= $_SESSION['UID'];
//Query for User Info
	$query = "SELECT * FROM users WHERE UID = '$uid'";
	$result = mysqli_query($conn, $query) or die ("Error querying database." . mysqli_error($conn));
	While ($row = mysqli_fetch_array($result)){
		$username=$row['username'];
		$fname=$row['fname'];
		$fnamenonce=$row['fnamenonce'];
		$tzone=$row['tzone'];
		$tzonenonce=$row['tzonenonce'];
	}
//Set name to display
	 if (!empty($fname)) {
		$displayName = sodium_crypto_secretbox_open($fname, $fnamenonce, $key);
	} else {
		$displayName = $username;
	}
//Set timzone
	if (!empty($tzone)) {
		$timezone = sodium_crypto_secretbox_open($tzone, $tzonenonce, $key);
	} else {
		$timezone = $utc;
	}
	date_default_timezone_set("$timezone");
?>
<html lang="en">
<head>
<title>Reeemind</title>
<link rel="shortcut icon" type="image/png" href="../includes/favicon.png"/>
<link rel="stylesheet" href="../includes/style.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&display=swap" />
<style type="text/css">
</style>
<script src="http://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function()  {
	$.post('rTable.php', result);
			function result(data){
				$('#d2').html(data);
		};
	$('body').on('click', '#newRecord', function(){
		$(document.body).css({ 'cursor': 'wait' });
		$.post('newRecord.php', result);
		function result(data){
			$(document.body).css({ 'cursor': 'default' });
			$('#d2').html(data);
		}
	}); //present newrecord form END
	$('body').on('click', '#resetAll', function(){
		$(document.body).css({ 'cursor': 'wait' });
		$.post('rTable.php', result);
		function result(data){
			$(document.body).css({ 'cursor': 'default' });
			$('#d2').html(data);
		}
	}); //present resetAll script END
	$('body').on('click', '#myAccount', function(){
		$(document.body).css({ 'cursor': 'wait' });
		$.post('myAccount.php', result);
		function result(data){
			$(document.body).css({ 'cursor': 'default' });
			$('#d2').html(data);
		}
	}); //present myAccount END
	$('body').on('click', '#signout', function(){
		$(document.body).css({ 'cursor': 'wait' });
		$.post('../login/logout.php', result);
		function result(data){
			$(document.body).css({ 'cursor': 'default' });
			$('#wrapper').html(data);
		}
	}); //present signout END
});  //  end document ready
</script>
</head>
<body>
	<div id="wrapper">
		<div id="topbar">
			<div id="topbartext">
				<a href="http://www.reeemind.com"><h4>Reeemind</h4></a>
			</div>
		</div>
		<div id ="heading">
			<h1>Welcome, <?php echo "$displayName"; ?></h1>
			<h4>Actions May Take Time to Process</h4>
		</div> <!-- end heading div -->
		<div id ="primaryContent">
			<div id="d1">
				<button id="newRecord" class="mButton">Create a New Record</button> <br />
				<button id="resetAll" class="mButton">Home</button> <br />
				<button id="primarySave" class="mButton">Save Changes</button> <br />
				<br />
			</div> <!-- end d1 div -->
			<div id="d2w">
				<div id="d2">
					<div id="mobileOptions">
						<button id="mobileDropdown" class="mButton mobile">My Account</button> <br />
						<button id="primarySave" class="mButton mobile">Archive</button> <br />
					</div>		
					<h2>Loading...</h2>
				</div> <!-- end d2 div -->	
			</div> <!-- end d2w div -->
			<div id="d3w">			
				<div id="d3">
					<div id="d3b">
						<button id="myAccount" class="mButton">My Account</button> <br />
						<button id="archive" class="mButton">Archive</button> <br />
						<button id="signout" class="mButton">Sign Out Session</button> <br />
					</div> <!-- end d3b div -->
				</div> <!-- end d3 div -->
			</div><!-- end d3w div -->
		</div> <!-- end primaryContent div -->	
<!--		<div id="footer">
			<footer id="credit">Created by Elijah Bassett</footer>
		</div>end credit div -->
	</div> <!-- end heading div -->		
</body>				