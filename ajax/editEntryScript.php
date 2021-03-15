<?php 
	include("../includes/dbConnect.php");
$pkey = '0';
$key = '1';
$status= "2";
	While ($pkey != $key) {
		$keyName = "$key-nrName";
		if (isset($_POST["$keyName"])){
			$keyContent = "$key-nrContent";
			$keyPriority = "$key-nrPriority";
			$keyComplete = "$key-nrComplete";
			$keyRID = "$key-nrRID";
			$erName= $_POST["$keyName"];
			$erContent= $_POST["$keyContent"];
			$erPriority= $_POST["$keyPriority"];
			$erComplete= $_POST["$keyComplete"];
			$erRID= $_POST["$keyRID"];
			if (empty($erContent)) {
				$errormsg = "<p class=\"error\">One or More Required Fields Were Left Empty.</p><br>"; //Display Error Msg
				$repost=true;
			} 	
			if (empty($erPriority ) || $erPriority == 'select') {
				$errormsg = "<p class=\"error\">One or More Required Fields Were Left Empty.</p><br>"; //Display Error Msg
				$repost=true;
			}	
			else if (empty($erComplete)) {
				$errormsg = "<p class=\"error\">One or More Required Fields Were Left Empty.</p><br>"; //Display Error Msg
				$repost=true;
			} 	
			//Formatting title + content
				if (!empty($erTitle) && $erContent) {
					$erDisplay = "<p class= \"nrdtitle\">$nrTitle </p> <p class=\"nrdcontent\">$nrContent</p>" ;
				} else {
					$erDisplay = $erContent;
				}
			$erTarget = strtotime($erComplete);				
			//if repost false, process data, write a new rcord to db		
			if ($repost == false){
//				$query = "INSERT INTO $usertable (UID, RID, Title, Content, Display, Complete, Priority, Status) VALUES ('$uid', '$nrCurrentTime', '$erTitle', '$erContent', '$erDisplay', '$erTarget', '$erPriority', '$status')";
				$query = "UPDATE $usertable SET Content = '$erContent', Display = '$erDisplay', Complete = '$erTarget', Priority = '$erPriority', Status = '$status' WHERE RID = $erRID";
				$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
				echo '<p class=\'success\'>Success</p>'; 
			} else {
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
					<div class="editBoxes">
					<form method="post" action="" id="editOptions" name="editOptions">
						<input type="hidden" name="key" id="key" value="<?php echo $key; ?>">
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
			}
//			echo "$erName ... $erContent ... $erPriority ... $erPriority";			
//			echo "Form $key made it."; 
			$key ++;	
		}//end if stament
		$pkey ++;
	}//end while
?>