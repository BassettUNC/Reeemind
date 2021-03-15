<?php
// Include config file
require_once "../../includes/dbConnect.php";
include("../../../etc/reeemind.com/tax/taxes.php");
$usertable= 'users';  
//query database using username
$username= $_POST['username'];
$query = "SELECT * FROM $usertable WHERE username = '$username'";
$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
$row = mysqli_fetch_array($result);
//define variables from query result
$username = $row['username'];
$email = $row['email'];
$enonce = $row['emailnonce'];
//write token if valid email
	if (!empty($email)) {
		// Create tokens
		$selector = bin2hex(random_bytes(8));
		$token = random_bytes(32);
        $htoken =  hash('sha256', $token);
	
		$url = sprintf('%rreeemind.com/login/reset/resetDestination.php?%s', ABS_URL, http_build_query([
			'selector' => $selector,
			'validator' => bin2hex($token)
		]));		
		// Token expiration
		$currentUnix = time();
		$expires = strtotime('+1 hour', $currentUnix); //current unix timestamp + 1 hour
		// Delete any existing tokens for this user
		$query = "UPDATE $usertable SET selector = '' WHERE username = '$username'";
		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));
		$query = "UPDATE $usertable SET token = '' WHERE username = '$username'";
		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));
		$query = "UPDATE $usertable SET expires = '0' WHERE username = '$username'";
		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));		
		// Insert reset token into database
		$query = "UPDATE $usertable SET selector = '$selector' WHERE username = '$username'";
		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));
		$query = "UPDATE $usertable SET token = '$htoken' WHERE username = '$username'";
		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));
		$query = "UPDATE $usertable SET expires = '$expires' WHERE username = '$username'";
		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable." . mysqli_error($conn));
		//decrypt email
		$demail = sodium_crypto_secretbox_open($email, $enonce, $key);
		// Send the email
		// Recipient
		$to = $demail;	
		// Subject
		$subject = 'Your Reeemind password reset link';	
		// Message
		$message = '<p>We recieved a password reset request. The link to reset your password is below. ';
		$message .= 'If you did not make this request, PLEASE imeadently reset your password and notify us by replying to this email.</p>';
		$message .= '<p>Here is your password reset link:</br>';
		$message .= sprintf('<a href="%s">%s</a></p>', $url, $url);
		$message .= '<p>Thanks!</p>';
		
		// Headers
		$adminName = 'Reeemind Support';
		$adminEmail = 'Support@Reemind.com';
		$headers = "From: " . $adminName . " <" . $adminEmail . ">\r\n";
		$headers .= "Reply-To: " . $adminEmail . "\r\n";
		$headers .= "Content-type: text/html\r\n";
		
		// Send email
		$sent = mail($to, $subject, $message, $headers);
		$notification = "<h3>Check your Email. It may take a few minutes to arrive.<h3>";
		
		//log action
		$remote = $_SERVER['REMOTE_ADDR'];
		$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$page = 'resetToken';
		$message = "Reset token generated.";
		$timestamp =  time();
		$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('un.$username', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
		$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));

	} else {
		$notification = '<p>Your Email was not found. Unfortunately you cannot reset your password. <br /><br />  <a href= "../../index.html" class= "wbutton" id="resetpassbutton">Home</a> </p>';
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
	</div>
</body>
</html>	