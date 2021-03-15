<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
<?php
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../ajax/dashboard.php");
    exit;
}
 
// Include config file
require_once "../includes/dbConnect.php";
$usertable= 'users';  
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
?>
<html>
<head>
<title>Reeemind</title>
<link rel="shortcut icon" type="image/png" href="../includes/favicon.png"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&display=swap" />
<link rel="stylesheet" href="../includes/style.css" />
<link rel="stylesheet" href="../includes/3barStyle.css" />
<meta charset="UTF-8">
<title>Reeemind</title>
<style type="text/css">
@media screen and (max-width: 430px) {
	body {
		overflow-y: visible;
	}
	#orangel {
		height: 40%;
	}
	#logininfo {
		bottom: 40%;
	}
	.socialmedia {
		width: 350px;
		bottom: 10%;
	}
	#ifdesired {
		margin-top: 10px;
	}
@media screen and (max-width: 376px) {
	body {
		overflow-y: visible;
	}
	#redl {
		height: 25%;
	}
	#orangel {
		height: 50%;
	}
	#logininfo {
/*		width: 250px;
*/		bottom: 50%;
	}
	.socialmedia {
		width: 250px;
		bottom: 2%;
	}
	#ifdesired {
		margin-top: 10px;
	}
}
</style>
<script src="https://www.google.com/recaptcha/api.js?render=6LdGBq4UAAAAAJQRIyiQgHao3LYo4aMz1c0CkVkn"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function()  {
		$('body').on('click', '#loginForm1Button', function(){
		$(document.body).css({ 'cursor': 'wait' });
		var formData= $('#loginForm1').serialize();
		$.post('loginScript.php', formData, result);
		function result(data){
			$(document.body).css({ 'cursor': 'default' });
			$('#logininfo').html(data);
		}
		return false;
	}); //Process primarySave end
});  //  end document ready
</script>
<script>
    grecaptcha.ready(function() {
    // do request for recaptcha token
    // response is promise with passed token
        grecaptcha.execute('6LdGBq4UAAAAAJQRIyiQgHao3LYo4aMz1c0CkVkn', {action:'validate_captcha'})
                  .then(function(token) {
            // add token value to form
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
</script>
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
					<h1>Welcome Back!</h1>
				</div>
			</div> <!-- end mheading div -->
			<div id ="rheading">
				<div class="vcentertext">
				</div>
			</div> <!-- end rheading div -->
		</div> <!-- end heading div -->
		<div id="orangel">
			<div id="logininfo">
				<h1 id="loginheading">Log In</h1>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="loginForm1">
					<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
					<input type="hidden" name="action" value="validate_captcha">
					<div class="form-group">
						<label>Username:</label>
						<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
					</div>    
					<div class="form-group">
						<label>Password:</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="form-group">
<!--						<input type="submit" class="wbutton" value="Login Now"> -->
<!--						<button class="wbutton g-recaptcha" data-sitekey="6Lfs0K0UAAAAAD7LXLOywO8aVl0LqI5_So7UvQd4" data-callback='Login Now'>Submit</button>-->
						<button class="wbutton" id="loginForm1Button">Login Now</button>
					</div>
				</form>
			</div>
		</div>
		<div id="bluel">
			<div class="socialmedia">
				<h1 id="ifdesired">If Assistance is Desired</h1>
				<a href="reset/resetGather.php" class="wbutton" id="resetpassbutton">Forgot Password?</a>
<!--				<input type="submit" class="wbutton" value="Reset Password" id="resetpassbutton">
-->				<div class="socialmediaicon">
					<a href="twitter.com"><img src="../media/twitter.png" height="47px" class="socialmediaicons"/></a>
					<a href="twitter.com"><img src="../media/email.png" height="47px" class="socialmediaicon"/></a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>	