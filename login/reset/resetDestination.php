<?php
require_once "../../includes/dbConnect.php";
// Check for tokens
$selector = filter_input(INPUT_GET, 'selector');
$validator = filter_input(INPUT_GET, 'validator');

if ( false !== ctype_xdigit( $selector ) && false !== ctype_xdigit( $validator ) ) :
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
					<form action="resetProcess.php" method="post">
						<input type="hidden" name="selector" value="<?php echo $selector; ?>">
						<input type="hidden" name="validator" value="<?php echo $validator; ?>">
						<label>New Password</label>
						<input type="password" class="form-control" name="password" required>
						<label>Confirm New Password</label>
						<input type="password" class="form-control" name="confirm_password" required>
						<input type="submit" class="wbutton" value="Submit">
					</form>
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
<?php endif; ?>
