<?php
require_once "../../includes/dbConnect.php";
include("../../../etc/reeemind.com/tax/taxes.php");
$usertable = 'users';
//variable defenition
$time = time();
$selector= $_POST['selector'];
$validator= $_POST['validator'];
$password= $_POST['password'];
$confirmPassword= $_POST['confirm_password'];

// Validate new password
if(empty(trim($password))){
	$new_password_err = "Please enter the new password.";     
} elseif(strlen(trim($password)) < 6){
	$new_password_err = "Password must have atleast 6 characters.";
} else{
	$new_password = trim($password);
}

// Validate confirm password
if(empty(trim($confirmPassword))){
	$confirm_password_err = "Please confirm the password.";
} else{
	$confirm_password = trim($confirmPassword);
	if(empty($new_password_err) && ($password != $confirmPassword)){
		$confirm_password_err = "Password did not match.";
	}
}	
// Check input errors before updating the database
if(empty($new_password_err) && empty($confirm_password_err)){
	// Get tokens
	$query = "SELECT * FROM $usertable WHERE selector = '$selector' AND expires >= '$time'";
	$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
	if (mysqli_num_rows($result) != 0){
		$row = mysqli_fetch_array($result); 
		$username = $row['username'];
		$email = $row['email'];
		$enonce = $row['emailnonce'];
		$demail = sodium_crypto_secretbox_open($email, $enonce, $key);
		$token = $row['token'];
		$calc = hash('sha256', hex2bin($validator));
		
		// Validate tokens
		if (hash_equals($calc, $token)){
			if (!empty($email)) {       
			// Update password
				$newPassword = password_hash($password, PASSWORD_DEFAULT);
				$query = "UPDATE $usertable SET password = '$newPassword' WHERE username = '$username'";
				$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));
			//Update timestamp
				$query = "UPDATE $usertable SET updatedAt = '$time' WHERE username = '$username'";
				$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));
			
			// Delete any existing password reset AND remember me tokens for this user
				$query = "UPDATE $usertable SET selector = '' WHERE username = '$username'";
				$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));
				$query = "UPDATE $usertable SET token = '' WHERE username = '$username'";
				$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));
				$query = "UPDATE $usertable SET expires = '0' WHERE username = '$username'";
				$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));		
			// Comfirm Succsess
				//destroy Session
				$_SESSION = array();
				session_destroy();   
				$_SESSION = array();
				$notification = '<p id="succsess"> Password updated successfully.</p><a href="../login.php" class= "wbutton" >Login here</a>';
				//log action
				$remote = $_SERVER['REMOTE_ADDR'];
				$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
				$page = 'resetProcess';
				$message = "Password reset";
				$timestamp =  time();
				$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('un.$username', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
				$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
				// Send notifcaiton email
				// Recipient
				$to = $demail;	
				// Subject
				$subject = 'Your Reeemind Password was Updated';	
				// Message
				$message = '<p>Your Reeemind Password was just Reset. ';
				$message .= 'If you did not make this request, PLEASE imeadently notify us by replying to this email.</p>';
				$message .= '<p>Thanks!</p>';
				
				// Headers
				$adminName = 'Reeemind Support';
				$adminEmail = 'Support@Reemind.com';
				$headers = "From: " . $adminName . " <" . $adminEmail . ">\r\n";
				$headers .= "Reply-To: " . $adminEmail . "\r\n";
				$headers .= "Content-type: text/html\r\n";
				
				// Send email
				$sent = mail($to, $subject, $message, $headers);
			} else {
				$notification = 'There was an error processing your request. Error Code: 003';
				//log error
				$remote = $_SERVER['REMOTE_ADDR'];
				$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
				$page = 'resetProcess';
				$message = "RESET FAILURE. email check failed.";
				$timestamp =  time();
				$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('un.$username', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
				$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
			}
		}
		   } else {
			// results not found
			$notification = 'There was an error processing your request. Please Try Again. <br /><br /><a href= "resetGather.php" class= "wbutton" id="resetpassbutton">Go Back</a> <br /><br /> Error Code: 002';
			//log error
			$remote = $_SERVER['REMOTE_ADDR'];
			$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
			$page = 'resetProcess';
			$message = "RESET FAILURE. Bad token.";
			$timestamp =  time();
			$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('un.$username', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
			$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
		}
} else {
//set to respost form 
$notification = "<form action=\"resetProcess.php\" method=\"post\">
					<label>New Password</label>
					<input type=\"password\" class=\"form-control\" name=\"password\" required>
					<span class=\"help-block\"><?php echo $new_password_err; ?></span>
					<label>Confirm New Password</label>
					<input type=\"password\" class=\"form-control\" name=\"confirm_password\" required>
				   <span class=\"help-block\"><?php echo $confirm_password_err; ?></span>
					<input type=\"submit\" class=\"wbutton\" value=\"Submit\">
				</form>";
}
?>
<html>
<head>
<title>Reeemind</title>
<link rel="shortcut icon" type="image/png" href="../../includes/favicon.png"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&display=swap" />
<link rel="stylesheet" href="../../includes/style.css" />
<link rel="stylesheet" href="../../includes/3barStyle.css" />
<head>
<meta charset="UTF-8">
<title>Reeemind</title>
<style type="text/css">
.socialmedia {
	height: 140px;
}
#logininfo {
	height: 123px;
	width: 235px;
}
#succsess {
}
</style>
</head>
<body>
	<div id="wrapper">
		<div id="topbar">
			<div id="topbartext">
				<a href="http://www.reeemind.com"><h4>Reeemind</h4></a>
			</div>
		</div>
		<div id="redl">
			<div id ="lheading">
				<div class="vcentertext">
				</div>
			</div> <!-- end lheading div -->
			<div id ="mheading">
				<div class="vcentertext">
					<h1>Reset Password</h1>
				</div>
			</div> <!-- end mheading div -->
			<div id ="rheading">
				<div class="vcentertext">
				</div>
			</div> <!-- end rheading div -->
		</div> <!-- end heading div -->
		<div id="orangel">
			<div id="logininfo">
				<?php echo "$notification"; ?>
			</div>
		</div>
		<div id="bluel">
			<div class="socialmedia">
				<h1 id="ifdesired">If Assistance is Desired</h1>
				<div class="socialmediaicon">
					<a href="twitter.com"><img src="../../media/twitter.png" height="47px" class="socialmediaicons"/></a>
					<a href="twitter.com"><img src="../../media/email.png" height="47px" class="socialmediaicon"/></a>
				</div>
		</div>
	</div>
</body>
</html>	