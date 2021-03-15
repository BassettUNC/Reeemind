<html>
<head>
<style type="text/css">
@media screen and (min-width: 1530px) {
	#d2 {
		display: inline-block;
		width: 400px;
		height: 150px;
		margin: auto;  
		position: absolute;
		left:0;
		right: 0;
		top: 40px;
		bottom: 0;
		padding: 15px;
	}
	.editBoxes {
		border: 2px solid #000000;
		border-radius: 10px;
		bottom: 0;
		padding: 15px;
		font-weight: bold;
		height: 150px;
		margin-bottom: 10px;
	}
}
@media screen and (max-width: 1530px) {
	#d2 {
		display: inline-block;
		width: 400px;
		height: auto;
		margin: 185px auto 0px auto;  
		position: absolute;
		left:0;
		right: 0;
		top: 40px;
		bottom: 0;
		padding: 15px;
		font-weight: bold;
	}
	.editBoxes {
		border: 2px solid #000000;
		border-radius: 10px;
		bottom: 0;
		padding: 15px;
		font-weight: bold;
		height: 150px;
		margin-bottom: 10px;
	}
}
	#primarySave {
		background-color: #ccffcc;
	}
	#resetAll {
		background-color: #ffcccc;
	}
	.hbackground {
		background-color: #ffe6e6;
	}
	.mbackground {
		background-color: #fff0e6;
	}
	.lbackground {
		background-color: #e6f9ff;
	}
	input, select {
		border-radius: 2px;
    	border: 1px solid;
    	background-color: white;
		padding: 1px;
	}

</style>
</head>
<?php
	include("../includes/dbConnect.php");
	$selected = $_POST['value'];		
	foreach ($selected as $key => $value) {
		$query = "SELECT * FROM Reminder WHERE (RID = '$value')";
		$result = mysqli_query($conn, $query) or die ("Error querying database." . mysqli_error($conn));
		While ($row = mysqli_fetch_array($result)){
			$SRdid=$row['DID'];
			$SRuid=$row['UID'];
			$SRrid=$row['RID'];
			$SRpriority=$row['Priority'];
			$SRconvert=$row['Complete'];
			$SRtitle=$row['Title'];
			$SRcontent=$row['Content'];		
			$completeDate = date('Y-m-d', $SRconvert); //convert user UNIX to viewable date
		}
		$key++;
		?>
		<h3> <?php echo $key ?>. </h3>
		<div class="editBoxes <?php if($SRpriority == '1'){echo 'hbackground';} if($SRpriority == '2'){echo 'mbackground';} if($SRpriority == '3'){echo 'lbackground';}?>">
		<form method="post" action="" id="editOptions" name="editOptions">
			<input type="hidden" name="<?php echo $key; ?>-nrRID" id="RID" value="<?php echo $SRrid; ?>">
			<label for="nrName">Title:</label>
				<input type="text" name="<?php echo $key; ?>-nrName" id="nrTitle" value="<?php echo $SRtitle; ?>">
			<br />
			<label for="nrContent">Content:</label>
				<input type="text" name="<?php echo $key; ?>-nrContent" id="nrContent" value="<?php echo $SRcontent; ?>">
			<br />
			<label for="nrPriority">Priority:</label>
			<select type="text" name="<?php echo $key; ?>-nrPriority" id="nrPrioritySelc">
				<option value="" <?php if ($SRpriority == 0) echo "selected"; ?>>Select</option>
				<option value="1" <?php if ($SRpriority == 1) echo "selected"; ?>>High</option>
				<option value="2" <?php if ($SRpriority == 2) echo "selected"; ?>>Medium</option>
				<option value="3" <?php if ($SRpriority == 3) echo "selected"; ?>>Low</option>
			</select>
			<br />
			<label for="nrComplete">Target Completion:</label>
				<input type="date" name="<?php echo $key; ?>-nrComplete" id="nrTarget" value="<?php echo $completeDate; ?>">
		</form>
		</div>
	<?php
	}
?>