<?php 
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login.php");
    exit;
}
?>
<html>
<head>
<style type="text/css">
@media screen and (min-width: 1530px) {
	#d2 {
		display: inline-block;
		border: 2px solid #000000;
		width: 400px;
		height: 150px;
		margin: auto;  
		position: absolute;
		left:0;
		right: 0;
		top: 40px;
		bottom: 0;
		padding: 15px;
		border-radius: 10px;
	}
}
@media screen and (max-width: 1530px) {
	#d2 {
		display: inline-block;
		border: 2px solid #000000;
		width: 400px;
		height: 150px;
		margin: 185px auto 0px auto;  
		position: absolute;
		left:0;
		right: 0;
		top: 40px;
		bottom: 0;
		padding: 15px;
		border-radius: 10px;
		font-weight: bold;
	}
}
input, select {
	border-radius: 2px;
	border: 1px solid;
	background-color: transparent;
}
</style>
</head>
<body>
<?php
	
//Db connection
	
include("../includes/dbConnect.php");
	
//Variable Definition
	
	$nrTitle= $_POST['nrName'];
	$nrPriority= $_POST['nrPriority']; // 1 is high, 2 is medium, 3 is low
	$nrComplete= $_POST['nrComplete'];
	$nrContent= $_POST['nrContent'];
	$status= "1"; // 1 is active, 2 is archived
	$uid= $_SESSION['UID']; //user id from session
	$repost= false;
//Setting time realted variables
	
	date_default_timezone_set('UTC');
	$nrTarget = strtotime($nrComplete);
	$nrCurrentTime =  time();

//Formatting title + content
	if (!empty($nrTitle) && $nrContent) {
		$nrDisplay = "<p class= \"nrdtitle\">$nrTitle </p> <p class=\"nrdcontent\">$nrContent</p>" ;
	} else {
		$nrDisplay = $nrContent;
	}		
//Vallidation, by checking variable values or user input

	if (empty($nrContent)) {
		$errormsg = "<p class=\"error\">One or More Required Fields Were Left Empty.</p><br>"; //Display Error Msg
		$repost=true;
	} 	
	if (empty($nrPriority ) || $nrPriority == 'select') {
		$errormsg = "<p class=\"error\">One or More Required Fields Were Left Empty.</p><br>"; //Display Error Msg
		$repost=true;
	}	
	else if (empty($nrComplete)) {
		$errormsg = "<p class=\"error\">One or More Required Fields Were Left Empty.</p><br>"; //Display Error Msg
		$repost=true;
	} 	

//if repost false, process data, write a new rcord to db
	
	if ($repost == false){
		$query = "INSERT INTO $usertable (UID, RID, Title, Content, Display, Complete, Priority, Status) VALUES ('$uid', '$nrCurrentTime', '$nrTitle', '$nrContent', '$nrDisplay', '$nrTarget', '$nrPriority', '$status')";
		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
		echo '<p class=\'success\'>Success</p>'; 
//log action	
		$remote = $_SERVER['REMOTE_ADDR'];
		$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$page = 'newRecordScript';
		$message = "New Record Created. RID = $nrCurrentTime";
		$timestamp =  time();
		$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('$uid', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
?> <script type="text/javascript">
	$.post('rTable.php', result);
			function result(data){
				$('#d2').html(data);
		};
	</script>
	<?php	
	} else {
	//display error and repost form 
?>
		<style type="text/css">
			#primarySave {
				background-color: #ccffcc;
			}
			#resetAll {
				background-color: #ffcccc;
			}
		</style>
		<?php echo $errormsg; ?>
			<form method="post" action="" id="newRecordForm">
				<label for="nrName">Title:</label>
					<input type="text" name="nrName" id="nrTitle" value="<?php echo $nrTitle; ?>">
				<br />
				<label for="nrContent">Content:</label>
					<input type="text" name="nrContent" id="nrContent" value="<?php echo $nrContent; ?>">
				<br />
				<label for="nrPriority">Priority:</label>
				<select type="text" name="nrPriority" id="nrPrioritySelc">
				<option value="" <?php if ($nrPriority == '0'){ echo "selected"; }?>>Select</option>
				<option value="1" <?php if ($nrPriority == '1'){ echo "selected"; }?>>High</option>
				<option value="2" <?php if ($nrPriority == '2'){ echo "selected"; }?>>Medium</option>
				<option value="3" <?php if ($nrPriority == '3'){ echo "selected"; }?>>Low</option>
				</select>
				<br />
				<label for="nrComplete">Target Completion:</label>
					<input type="date" name="nrComplete" id="nrTarget" value="<?php echo $nrComplete; ?>">
			</form>
<?php
	} //close else statement	
?>
</body>
</html>