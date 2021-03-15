<html> 
<style type="text/css">
#d2 {
    display: inline-block;
    border: 2px solid #000000;
    width: 550px;
    height: 450px;
    margin: 185px auto 0px auto;
    position: absolute;
    left: 0;
    right: 0;
    top: 40px;
    bottom: 0;
    padding: 15px;
    font-weight: bold;
    border-radius: 10px;
}
.maLabel {
	display: inline-block;
	margin: 10px 5px 5px 0px;
}
input, select {
	border-radius: 2px;
	border: 1px solid;
	background-color: transparent;
	width: 200px;
}
#maForm {
	width: 200px;
    margin: auto;
    text-align: center;
}
#maButtons {
    width: 308px;
    margin: 10px auto 0px auto;
}
#ma {
	top: 6%;
	position:relative;
}
.maButton {
	color: #ff3333;
    border: 2px #ff3333 solid;
}
#maHeading {
	text-align: center;
	margin-bottom: 5px;
}
#primarySave {
	background-color: #ccffcc;
}
#resetAll {
	background-color: #ffcccc;
}
@media screen and (min-width: 1530px) {
	#d2 {
		display: inline-block;
		border: 2px solid #000000;
		width: 550px;
		height: 450px;
		margin: -80px auto 0px auto;
		position: absolute;
		left: 0;
		right: 0;
		top: 40px;
		bottom: 0;
		padding: 15px;
		font-weight: bold;
		border-radius: 10px;
	}
}
</style>
<?php 
session_start();
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
		$email=$row['email'];
		$emailnonce=$row['emailnonce'];
		$tzone=$row['tzone'];
		$tzonenonce=$row['tzonenonce'];
	}
//log action	
$remote = $_SERVER['REMOTE_ADDR'];
$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
$page = 'myAccount';
$message = 'Query to fill account details on My Account. Decryption follows';
$timestamp =  time();
$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('$uid', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
//Decryption
	 if (!empty($fname)) {
		$displayName = sodium_crypto_secretbox_open($fname, $fnamenonce, $key);
	}
	 if (!empty($email)) {
		$displayEmail = sodium_crypto_secretbox_open($email, $emailnonce, $key);
	}
	 if (!empty($tzone)) {
		$displayTzone = sodium_crypto_secretbox_open($tzone, $tzonenonce, $key);
	}
?>
<h1 id="maHeading">Your Account</h1>
<div id="ma">
<form action="" method="post" id="maForm">
	<div id="username" class="maOption">
		<h3 class="maLabel">Username</h3> <br /> <input id="maUsername" class="maInput" value="<?php echo $username; ?>">
	</div>
	<div id="email" class="maOption">
		<h3 class="maLabel">Email</h3> <br /> <input id="maEmail" class="maInput" value="<?php echo $displayEmail; ?>">
	</div>
	<div id="fname" class="maOption">
		<h3 class="maLabel">First Name</h3> <br /> <input id="maFname" class="maInput" value="<?php echo $displayName; ?>">
	</div>
	<div id="timezone1" class="maOption">
		<h3 class="maLabel">Timezone</h3> <br />
		<?php
			$regions = array(
				'America' => DateTimeZone::AMERICA,
				'Europe' => DateTimeZone::EUROPE,
				'Asia' => DateTimeZone::ASIA,
				'Africa' => DateTimeZone::AFRICA,
				'Indian' => DateTimeZone::INDIAN,
				'Pacific' => DateTimeZone::PACIFIC,
				'Atlantic' => DateTimeZone::ATLANTIC,
				'Antarctica' => DateTimeZone::ANTARCTICA
			);
			$timezones = array();
			foreach ($regions as $name => $mask)
			{
				$zones = DateTimeZone::listIdentifiers($mask);
				foreach($zones as $timezone)
				{
					// Lets sample the time there right now
					$time = new DateTime(NULL, new DateTimeZone($timezone));
					// handle millitary time
					$ampm = $time->format('H') > 12 ? ' ('. $time->format('g:i a'). ')' : '';
					// Remove region name and add a sample time
					$timezones[$name][$timezone] = substr($timezone, strlen($name) + 1) . ': ' . $time->format('H:i') . $ampm;
				}
			}
			// View
			print '<select name="maTzone" id="maTzone" class="form-control">';
			foreach($timezones as $region => $list)
			{
				print '<optgroup label="' . $region . '">' . "\n";
				foreach($list as $timezone => $name)
				{
					$name1 = str_replace("_"," ",$name);
					if ($timezone == $displayTzone){
						$selected = 'selected';
					} else {
						$selected ='';
					}
					print '<option name="' . $timezone . '" value="' . $timezone . '" ' . $selected . ' >' . $name1 . '</option>' . "\n";
				}
				print '<optgroup>' . "\n";
			}
			print '</select>';
			?>								
	</div>
</form>
<div id="maButtons">
	<button id="resetPassword" class="mButton maButton">Reset Password</button>
	<button id="deleteAccount" class="mButton maButton">Delete Account</button>
</div>
</div>
</html>