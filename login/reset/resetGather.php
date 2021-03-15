<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../../ajax/dashboard.php");
    exit;
} else {
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
	height: 70px;
	width: 300px;
}
#logininfo {
	height: 156px;
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
				<h4>IF there is an email accociated with your account, you will recive a message with a link to reset your password.</h4> <br />
				<form action="resetToken.php" method="post" id="resetToken">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control">
					</div>    
					<div class="form-group">
						<input type="submit" name="subitrtokenform" id="subitrtokenform" class="wbutton">
					</div>
				</form>
			</div>
		</div>
		<div id="bluel">
			<div class="socialmedia">
			<h4> If you did not accociate an email with your an account, you will NOT, under any circumstances, be premiteed to reset your account password.</h4>
			</div>
		</div>
	</div>
</body>
</html>	
<!--close logged-in if staement-->
<?php
}
?>