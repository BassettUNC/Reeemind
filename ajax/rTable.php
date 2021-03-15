<?php 
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login.php");
    exit;
}
?>
<head>
<style type="text/css">
@media screen and (min-width: 1530px) {
	#d2 {
		display: inline-block;
		height: 150px;
		margin:  auto;  
		position: absolute;
		left: 0;
		right: 0;
		top: 40px;
		bottom: 0;
		width: 965px;
	}
	#dhtable {
		border: 2px solid #000000;
		width: 300px;
		min-height: 600px;
		float: left;
		position: absolute;
		margin: 0px 0px 30px 0px;
		display: inline-block;
		background-color:#ffe6e6;
		border-radius: 10px;
	}
	#dmtable {
		border: 2px solid #000000;
		width: 300px;
		min-height: 600px;
		margin: 0px 0px 30px 330px;
		position: absolute;
		background-color: #fff0e6;
		border-radius: 10px;
	}
	#dltable {
		border: 2px solid #000000;
		width: 300px;
		min-height: 600px;
		margin: 0px 0px 30px 660px;
		position: absolute;
		background-color: #e6f9ff;
		border-radius: 10px;
	}
	table {
		width: 100%;
		border-collapse: collapse;
	}
	th {
		height: 50px;
		border-top: 2px solid black;
		border-collapse: collapse;	
	}
	#redcell {
		text-align:center;
		font-size:24px;
		background-color:#ff3333;
		padding:9px;
		border-top-left-radius: 8px;
   	 	border-top-right-radius: 8px;	
	}
	#orangecell {
		text-align:center;
		font-size:24px;
		background-color:#ff8533;
		padding:9px;
		border-top-left-radius: 8px;
   	 	border-top-right-radius: 8px;
	}		
	#bluecell {
		text-align:center;
		font-size:24px;
		background-color:#80dfff;
		padding:9px;
		border-top-left-radius: 8px;
    	border-top-right-radius: 8px;	
	}		
	.tcell {
		width:70px;
	}
	.nrdtitle {
		font-weight:bold;
	}
	.tLeft {
		border-right: 2px solid;
		border-bottom: 2px solid;
		border-top: 2px solid;
	}
	.tRight {
		border-top: 2px solid;
		border-bottom: 2px solid;
	}
	.thead {
		border-top: 2px solid;	
	}
	td {
		padding-left:5px;
		padding-right:5px;
	}
	.tLate {
		color: #ff3333;
		font-weight: bold;
	}
}
@media screen and (min-width: 986px) and (max-width: 1530px) {
	#d2 {
		display: inline-block;
		height: 150px;
		margin: 200 auto 0 auto;  
		position: absolute;
		left: 0;
		right: 0;
		top: 40px;
		bottom: 0;
		width: 965px;
	}
	#dhtable {
		border: 2px solid #000000;
		width: 300px;
		min-height: 600px;
		float: left;
		position: absolute;
		margin: 0px 0px 30px 0px;
		display: inline-block;
		background-color:#ffe6e6;
		border-radius: 10px;
	}
	#dmtable {
		border: 2px solid #000000;
		width: 300px;
		min-height: 600px;
		margin: 0px 0px 30px 330px;
		position: absolute;
		background-color: #fff0e6;
		border-radius: 10px;
	}
	#dltable {
		border: 2px solid #000000;
		width: 300px;
		min-height: 600px;
		margin: 0px 0px 30px 660px;
		position: absolute;
		background-color: #e6f9ff;
		border-radius: 10px;
	}
	table {
		width: 100%;
		border-collapse: collapse;
	}
	th {
		height: 50px;
		border-top: 2px solid black;
		border-collapse: collapse;	
	}
	#redcell {
		text-align:center;
		font-size:24px;
		background-color:#ff3333;
		padding:9px;
		border-top-left-radius: 8px;
   	 	border-top-right-radius: 8px;	
	}
	#orangecell {
		text-align:center;
		font-size:24px;
		background-color:#ff8533;
		padding:9px;
		border-top-left-radius: 8px;
   	 	border-top-right-radius: 8px;
	}		
	#bluecell {
		text-align:center;
		font-size:24px;
		background-color:#80dfff;
		padding:9px;
		border-top-left-radius: 8px;
    	border-top-right-radius: 8px;	
	}		
	.tcell {
		width:70px;
	}
	.nrdtitle {
		font-weight:bold;
	}
	.tLeft {
		border-right: 2px solid;
		border-top: 2px solid;
		border-bottom: 2px solid;
	}
	.tRight {
		border-top: 2px solid;
		border-bottom: 2px solid;
	}
	.thead {
		border-top: 2px solid;	
	}
	td {
		padding-left:5px;
		padding-right:5px;
	}
	.tLate {
		color: #ff3333;
		font-weight: bold;
	}
}
@media screen and (max-width: 985px) {
	#d2 {
		display: inline-block;
		height: 150px;
		margin: 200 auto 0 auto;  
		position: absolute;
		left: 0;
		right: 0;
		top: 40px;
		bottom: 0;
	}
	#dhtable {
		border: 2px solid #000000;
		width: 300px;
		margin: 0px auto;
		background-color:#ffe6e6;
		border-radius: 10px;
	}
	#dmtable {
		border: 2px solid #000000;
		width: 300px;
		margin: 10px auto 0px auto;
		background-color: #fff0e6;
		border-radius: 10px;
	}
	#dltable {
		border: 2px solid #000000;
		width: 300px;
		margin: 10px auto 30px auto;
		background-color: #e6f9ff;
		border-radius: 10px;
	}
	table {
		width: 100%;
		border-collapse: collapse;
	}
	th {
		height: 50px;
		border-top: 2px solid black;
		border-collapse: collapse;	
	}
	#redcell {
		text-align:center;
		font-size:24px;
		background-color:#ff3333;
		padding:9px;
		border-top-left-radius: 8px;
   	 	border-top-right-radius: 8px;	
	}
	#orangecell {
		text-align:center;
		font-size:24px;
		background-color:#ff8533;
		padding:9px;
		border-top-left-radius: 8px;
   	 	border-top-right-radius: 8px;
	}		
	#bluecell {
		text-align:center;
		font-size:24px;
		background-color:#80dfff;
		padding:9px;
		border-top-left-radius: 8px;
    	border-top-right-radius: 8px;	
	}		
	.tcell {
		width:70px;
	}
	.nrdtitle {
		font-weight:bold;
	}
	.tLeft {
		border-right: 2px solid;
		border-top: 2px solid;
	}
	.tRight {
		border-top: 2px solid;
	}
	.thead {
		border-top: 2px solid;	
	}
	td {
		padding-left:5px;
		padding-right:5px;
	}
	.tLate {
		color: #ff3333;
		font-weight: bold;
	}
	.green {
		background-color:#00FF00;
	}
}
.hselected {
    background-color: #ffcccc;
}
.mselected {
    background-color: #ffe0cc;
}
.lselected {
    background-color: #ccf2ff;
}
.hidden {
	display: none;
}
</style>
<script type="text/javascript">
/* Apply class 'selected' to what table rows user selects*/
	$("#hTable tr").click(function(){
	   $(this).toggleClass('hselected selected');    
	   var value=$(this).find('td:first').html();
	});

	$("#mTable tr").click(function(){
	   $(this).toggleClass('mselected selected');    
	   var value=$(this).find('td:first').html();
	});
	$("#lTable tr").click(function(){
	   $(this).toggleClass('lselected selected');    
	   var value=$(this).find('td:first').html();
	});
/* Display entry buttons if tr is selected*/	
	$("tr").click(function(){
			if ($("tr").hasClass("selected")) { 
				$('#entrybutton').show("blind", 100);
			} else { 				  			
				$('#entrybutton').hide("blind", 100);
			}
	});	
/* On button click, create array*/	
		$('#editEntryButton').on('click', function(e){
			var selected = [];
			$("#hTable tr.hselected").each(function(){
				selected.push($('td:first', this).html());
			});
			$("#mTable tr.mselected").each(function(){
				selected.push($('td:first', this).html());
			});
			$("#lTable tr.lselected").each(function(){
				selected.push($('td:first', this).html());
			});
	/* Send array to php*/	
		$.post("editEntry.php", {value: selected}, function(data){   
		  $('#d2').html(data);
		});
	});
		$('#deleteEntryButton').on('click', function(e){
			var selected = [];
			$("#hTable tr.hselected").each(function(){
				selected.push($('td:first', this).html());
			});
			$("#mTable tr.mselected").each(function(){
				selected.push($('td:first', this).html());
			});
			$("#lTable tr.lselected").each(function(){
				selected.push($('td:first', this).html());
			});
	/* Send array to php*/	
		$.post("deleteEntry.php", {value: selected}, function(data){   
		  $('#d2').html(data);
		});
	});
		$('body').on('click', '#primarySave', function(){
		$(document.body).css({ 'cursor': 'wait' });
		var formData= $('form').serialize();
		$.post('editEntryScript.php', formData, result);
		function result(data){
			$(document.body).css({ 'cursor': 'default' });
			$('#d2').html(data);
		}
	}); //Process primarySave end
</script>
</head>
<?php	
//Db connection	
include("../includes/dbConnect.php");
include("../../etc/reeemind.com/tax/taxes.php");
$uid= $_SESSION['UID'];
//log action	
	$remote = $_SERVER['REMOTE_ADDR'];
	$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
	$page = 'rTable';
	$message = "rTable Queried.";
	$timestamp =  time();
	$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('$uid', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
	$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
//Query for User Info
	$query = "SELECT * FROM users WHERE UID = '$uid'";
	$result = mysqli_query($conn, $query) or die ("Error querying database." . mysqli_error($conn));
	While ($row = mysqli_fetch_array($result)){
		$tzone=$row['tzone'];
		$tzonenonce=$row['tzonenonce'];
	}
//Set timzone offsett
	date_default_timezone_set("UTC");
	if (!empty($tzone)) {
		$timezone = sodium_crypto_secretbox_open($tzone, $tzonenonce, $key);
		$tz=timezone_open("$timezone");
		$dateTimeOslo=date_create("now",timezone_open("$timezone"));
		$toffset = timezone_offset_get($tz,$dateTimeOslo);	
	} else {
		$toffset = '0';
	}
	date_default_timezone_set("UTC");
	$plus = '+';
	$seconds=  ' seconds';
//set blanket time variables
	$date = new DateTime("now", new DateTimeZone($timezone));//time based on user timzone
	$currentDate = $date->format('Y-m-d');
	$currentUnix = strtotime($currentDate);
	$usingtzone = strtotime("$plus$toffset$seconds", $currentUnix);
	$wholeday = strtotime('+1 day', $usingtzone);
	$plus2days = strtotime('+2 day', $usingtzone);
	$plus7days = strtotime('+7 day', $usingtzone); //current unix timestamp + 7 days
	$minuswholeday = strtotime('-1 day', $usingtzone);
	$minus2days = strtotime('-2 day', $usingtzone);
	$minus3days = strtotime('-3 day', $usingtzone);
	$minus4days = strtotime('-4 day', $usingtzone);
	$minus5days = strtotime('-5 day', $usingtzone);
	$minus6days = strtotime('-6 day', $usingtzone);
	$minus7days = strtotime('-7 day', $usingtzone);

?>
<body>
<div id="entrybutton" style="display:none;">
	<div id="insideentrybutton">
		<input type="button" id="editEntryButton" class="entryButtons" value="Edit" />
		<input type="button" id="deleteEntryButton" class="entryButtons" value="Delete" />
	</div>
</div>
<div id="dhtable" class="dprimaryDT">
<table id="hTable" class="primaryDT">
	<caption id="redcell">High</caption>
	<tr>
		<th class="tcell tLeft thead">Target</th>
		<th class="tRight thead">Reminder</th>
	</tr>
<?php 
//Execute HIGH Search
	$query = "SELECT * FROM $usertable WHERE (UID = '$uid' && (Status = '1' OR Status = '2') && Priority = '1') ORDER BY Complete";
	$result = mysqli_query($conn, $query) or die ("Error querying database." . mysqli_error($conn));
	While ($row = mysqli_fetch_array($result)){
		$SRdid=$row['DID'];
		$SRuid=$row['UID'];
		$SRrid=$row['RID'];
		$SRdisplay=$row['Display'];
		$SRpriority=$row['Priority'];
		$SRstatus=$row['Status'];
// Converting UNIX to user friendly text 
		$SRconvert=$row['Complete'];
		$SRcomplete = new DateTime("@$SRconvert");  //convert user UNIX timestamp to PHP DateTime !!DO NOT DISPLAY!! 
		$udate = date('m/d/y', $SRconvert); //convert user UNIX to viewable date
		$day = intval($SRcomplete->format('w')); //convert date to day of week
		if (($SRconvert > $minus7days) && ($SRconvert < $minus6days)) {
			$wday = '<p class="tLate"> Days</p>';
			}
		elseif (($SRconvert > $minus6days) && ($SRconvert < $minus5days)) {
			$wday = '<p class="tLate">6 Days</p>';
			}
		elseif (($SRconvert > $minus5days) && ($SRconvert < $minus4days)) {
			$wday = '<p class="tLate">5 Days</p>';
			}
		elseif (($SRconvert > $minus4days) && ($SRconvert < $minus3days)) {
			$wday = '<p class="tLate">4 Days</p>';
			}
		elseif (($SRconvert > $minus3days) && ($SRconvert < $minus2days)) {
			$wday = '<p class="tLate">3 Days</p>';
			}
		elseif (($SRconvert > $minus2days) && ($SRconvert < $minuswholeday)) {
			$wday = '<p class="tLate">2 Days</p>';
			}
		elseif (($SRconvert > $minuswholeday) && ($SRconvert < $usingtzone)) {
			$wday = '<p class="tLate">Yesterday</p>';
			}
		elseif ($SRconvert < $usingtzone) {
			$wday = '<p class="tLate">LATE</p>';
			}
		elseif ($SRconvert < $wholeday) {
			$wday = '<p class="tToday">Today</p>';
			}
		elseif ($SRconvert < $plus2days) {
			$wday = '<p class="tToday">Tomorrow</p>';
			}
		elseif ($day == '1') {
			$wday = '<p>Monday</p>';
			}
		elseif ($day == '2') {
			$wday = '<p>Tuesday</p>';
			}
		elseif ($day == '3') {
			$wday = '<p>Wedsnesday</p>';
			}
		elseif ($day == '4') {
			$wday = '<p>Thursday</p>';
			}
		elseif ($day == '5') {
			$wday = '<p>Friday</p>';
			}
		elseif ($day == '6') {
			$wday = '<p>Saturday</p>';
			}
		elseif ($day == '7') {
			$wday = '<p>Sunday</p>';
			} 
		else {
			$wday = "$udate";
			}
//Display Reminder Table
		echo"<tr>
			<td class=\"hidden\" name=\"SRrid\"> $SRrid </td>
			 <td class=\"tLeft\">";
			if ($SRconvert <= $plus7days) {
				echo $wday;
				} else
					{ 
			 echo $SRcomplete->format('m/d/y'); 
			 }
			 echo "</td>
			 <td class=\"tRight\">$SRdisplay</td>
			 </tr>";
	}
?>	
</table>
</div>
<div id="dmtable" class="dprimaryDT">
<table id="mTable" class="primaryDT" border="2px">
	<caption id="orangecell">Medium</caption>
	<tr>
		<th class="tcell tLeft thead">Target</th>
		<th class="tRight thead">Reminder</th>
	</tr>
<?php 
//Execute MEDIUM Search
	$query = "SELECT * FROM $usertable WHERE (UID = '$uid' && (Status = '1' OR Status = '2') && Priority = '2') ORDER BY Complete";
	$result = mysqli_query($conn, $query) or die ("Error querying database." . mysqli_error($conn));
	While ($row = mysqli_fetch_array($result)){
		$SRdid=$row['DID'];
		$SRuid=$row['UID'];
		$SRrid=$row['RID'];
		$SRdisplay=$row['Display'];
		$SRpriority=$row['Priority'];
		$SRstatus=$row['Status'];
// Converting UNIX to user friendly text 
		$SRconvert=$row['Complete'];
		$SRcomplete = new DateTime("@$SRconvert");  //convert user UNIX timestamp to PHP DateTime !!DO NOT DISPLAY!! 
		$udate = date('m/d/y', $SRconvert); //convert user UNIX to viewable date
		$day = intval($SRcomplete->format('w')); //convert date to day of week
		if (($SRconvert > $minus7days) && ($SRconvert < $minus6days)) {
			$wday = '<p class="tLate"> Days</p>';
			}
		elseif (($SRconvert > $minus6days) && ($SRconvert < $minus5days)) {
			$wday = '<p class="tLate">6 Days</p>';
			}
		elseif (($SRconvert > $minus5days) && ($SRconvert < $minus4days)) {
			$wday = '<p class="tLate">5 Days</p>';
			}
		elseif (($SRconvert > $minus4days) && ($SRconvert < $minus3days)) {
			$wday = '<p class="tLate">4 Days</p>';
			}
		elseif (($SRconvert > $minus3days) && ($SRconvert < $minus2days)) {
			$wday = '<p class="tLate">3 Days</p>';
			}
		elseif (($SRconvert > $minus2days) && ($SRconvert < $minuswholeday)) {
			$wday = '<p class="tLate">2 Days</p>';
			}
		elseif (($SRconvert > $minuswholeday) && ($SRconvert < $usingtzone)) {
			$wday = '<p class="tLate">Yesterday</p>';
			}
		elseif ($SRconvert < $usingtzone) {
			$wday = '<p class="tLate">LATE</p>';
			}
		elseif ($SRconvert < $wholeday) {
			$wday = '<p class="tToday">Today</p>';
			}
		elseif ($SRconvert < $plus2days) {
			$wday = '<p class="tToday">Tomorrow</p>';
			}
		elseif ($day == '1') {
			$wday = '<p>Monday</p>';
			}
		elseif ($day == '2') {
			$wday = '<p>Tuesday</p>';
			}
		elseif ($day == '3') {
			$wday = '<p>Wedsnesday</p>';
			}
		elseif ($day == '4') {
			$wday = '<p>Thursday</p>';
			}
		elseif ($day == '5') {
			$wday = '<p>Friday</p>';
			}
		elseif ($day == '6') {
			$wday = '<p>Saturday</p>';
			}
		elseif ($day == '7') {
			$wday = '<p>Sunday</p>';
			} 
		else {
			$wday = "$udate";
			}
//Display Reminder Table
		echo"<tr>
			<td class=\"hidden\" name=\"SRrid\"> $SRrid </td>
			 <td class=\"tLeft\">";
			if ($SRconvert <= $plus7days) {
				echo $wday;
				} else
					{ 
			 echo $SRcomplete->format('m/d/y'); 
			 }
			 echo "</td>
			 <td class=\"tRight\">$SRdisplay</td>
			 </tr>";
	}
?>	
</table>
</div>
<div id="dltable" class="dprimaryDT">
<table id="lTable" class="primaryDT">
	<caption id="bluecell">Low</caption>
	<tr>
		<th class="tcell tLeft thead">Target</th>
		<th class="tRight thead">Reminder</th>
	</tr>
<?php 
//Execute LOW Search
	$query = "SELECT * FROM $usertable WHERE (UID = '$uid' && (Status = '1' OR Status = '2') && Priority = '3') ORDER BY Complete";
	$result = mysqli_query($conn, $query) or die ("Error querying database." . mysqli_error($conn));
	While ($row = mysqli_fetch_array($result)){
		$SRdid=$row['DID'];
		$SRuid=$row['UID'];
		$SRrid=$row['RID'];
		$SRdisplay=$row['Display'];
		$SRpriority=$row['Priority'];
		$SRstatus=$row['Status'];
// Converting UNIX to user friendly text 
		$SRconvert=$row['Complete'];
		$SRcomplete = new DateTime("@$SRconvert");  //convert user UNIX timestamp to PHP DateTime !!DO NOT DISPLAY!! 
		$udate = date('m/d/y', $SRconvert); //convert user UNIX to viewable date
		$day = intval($SRcomplete->format('w')); //convert date to day of week
		if (($SRconvert > $minus7days) && ($SRconvert < $minus6days)) {
			$wday = '<p class="tLate"> Days</p>';
			}
		elseif (($SRconvert > $minus6days) && ($SRconvert < $minus5days)) {
			$wday = '<p class="tLate">6 Days</p>';
			}
		elseif (($SRconvert > $minus5days) && ($SRconvert < $minus4days)) {
			$wday = '<p class="tLate">5 Days</p>';
			}
		elseif (($SRconvert > $minus4days) && ($SRconvert < $minus3days)) {
			$wday = '<p class="tLate">4 Days</p>';
			}
		elseif (($SRconvert > $minus3days) && ($SRconvert < $minus2days)) {
			$wday = '<p class="tLate">3 Days</p>';
			}
		elseif (($SRconvert > $minus2days) && ($SRconvert < $minuswholeday)) {
			$wday = '<p class="tLate">2 Days</p>';
			}
		elseif (($SRconvert > $minuswholeday) && ($SRconvert < $usingtzone)) {
			$wday = '<p class="tLate">Yesterday</p>';
			}
		elseif ($SRconvert < $usingtzone) {
			$wday = '<p class="tLate">LATE</p>';
			}
		elseif ($SRconvert < $wholeday) {
			$wday = '<p class="tToday">Today</p>';
			}
		elseif ($SRconvert < $plus2days) {
			$wday = '<p class="tToday">Tomorrow</p>';
			}
		elseif ($day == '1') {
			$wday = '<p>Monday</p>';
			}
		elseif ($day == '2') {
			$wday = '<p>Tuesday</p>';
			}
		elseif ($day == '3') {
			$wday = '<p>Wedsnesday</p>';
			}
		elseif ($day == '4') {
			$wday = '<p>Thursday</p>';
			}
		elseif ($day == '5') {
			$wday = '<p>Friday</p>';
			}
		elseif ($day == '6') {
			$wday = '<p>Saturday</p>';
			}
		elseif ($day == '7') {
			$wday = '<p>Sunday</p>';
			} 
		else {
			$wday = "$udate";
			}
//Display Reminder Table
		echo"<tr>
			<td class=\"hidden\" name=\"SRrid\"> $SRrid </td>
			 <td class=\"tLeft\">";
			if ($SRconvert <= $plus7days) {
				echo $wday;
				} else
					{ 
			 echo $SRcomplete->format('m/d/y'); 
			 }
			 echo "</td>
			 <td class=\"tRight\">$SRdisplay</td>
			 </tr>";
	}
?>	
</table>
</div>
