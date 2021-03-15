<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
<?php
//Google Recaptcha
    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    } else
        $captcha = false;

    if(!$captcha){
	//Issue with service
		echo 'There has been an issue with the reCAPTCHA service. Please try again.';
		die ();
    }
    else{
		$privatekey = "6LdGBq4UAAAAAMiyAZzDEyLCPIi0HReBfYqIpZrH";
		$captcha = $_POST['g-recaptcha-response'];
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array(
			'secret' => $privatekey,
			'response' => $captcha,
			'remoteip' => $_SERVER['REMOTE_ADDR']
		);
	//curl is neccecary to handle HTTPS 		
		$curlConfig = array(
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => $data
		);		
		$ch = curl_init();
		curl_setopt_array($ch, $curlConfig);
		$response = curl_exec($ch);
		curl_close($ch);
		$jsonResponse = json_decode($response);
		//interpreting json repsonse 
        if($jsonResponse->success === false){
			//They're a Robot
			echo 'ERROR 1: The genius\'s over at google think you\'re a robot. If you aren\'t, pleast try again or try a different browser.';
			die ();
			}
			if($jsonResponse->score <= '.4'){
			//They're a Robot
			echo 'ERROR 2: The genius\'s over at google think you\'re a robot. If you aren\'t, pleast try again or try a different browser.';
			die ();
			}
    } // If user isn't a robot, continue.

// Include config file
require_once "../includes/dbConnect.php";
$usertable= 'users';  
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	 
		// Check if username is empty
		if(empty(trim($_POST["username"]))){
			$username_err = "<br />Please enter username.";
		} else{
			$username = trim($_POST["username"]);
		}
		
		// Check if password is empty
		if(empty(trim($_POST["password"]))){
			$password_err = "<br />Please enter your password.";
		} else{
			$password = trim($_POST["password"]);
		}
		
		// Validate credentials
		if(empty($username_err) && empty($password_err)){
			// Prepare a select statement
			$sql = "SELECT UID, username, password FROM users WHERE username = ?";
			
			if($stmt = mysqli_prepare($conn, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);
				
				// Set parameters
				$param_username = $username;
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Store result
					mysqli_stmt_store_result($stmt);
					
					// Check if username exists, if yes then verify password
					if(mysqli_stmt_num_rows($stmt) == 1){                    
						// Bind result variables
						mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
						if(mysqli_stmt_fetch($stmt)){
							if(password_verify($password, $hashed_password)){
								// Password is correct, so start a new session
								session_start();
								
								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["UID"] = $id;
								//log action
								$remote = $_SERVER['REMOTE_ADDR'];
								$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
								$page = 'loginScript';
								$message = "User Successfully logged in.";
								$timestamp =  time();
								$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('$id', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
								$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
								// Redirect user to welcome page
								?>
								<script type="text/javascript">
									window.location.replace("https://reeemind.com/ajax/dashboard.php");
								</script>
								<?php
							} else{
								// Display an error message if password is not valid
								$password_err = "<br />The password / username combination you entered was not valid.";
								//log action
								$remote = $_SERVER['REMOTE_ADDR'];
								$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
								$page = 'loginScript';
								$message = "FAILED LOGIN. Bad Password.";
								$timestamp =  time();
								$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('$id', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
								$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
							}
						}
					} else{
						// Display an error message if username doesn't exist
						//$username_err = "<br />No account found with that username.";
						$password_err = "<br />The password / username combination you entered was not valid.";
						//log action
						$remote = $_SERVER['REMOTE_ADDR'];
						$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
						$page = 'loginScript';
						$message = "FAILED LOGIN. Bad Username.";
						$timestamp =  time();
						$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('un.$username', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
						$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
					}
				} else{
					echo "<br />Oops! Something went wrong. Please try again later.";
					//log action
					$remote = $_SERVER['REMOTE_ADDR'];
					$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
					$page = 'loginScript';
					$message = "FAILED LOGIN. Error.";
					$timestamp =  time();
					$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('un.$username', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
					$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
				}
			}
			
			// Close statement
			mysqli_stmt_close($stmt);
		}
		
		// Close connection
		mysqli_close($conn);
		}
?>
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
				<h1 id="loginheading">Log In</h1>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="loginForm1">
					<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
					<input type="hidden" name="action" value="validate_captcha">
					<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
						<label>Username:</label>
						<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
						<span class="help-block"><?php echo $username_err; ?></span>
					</div>    
					<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<label>Password:</label>
						<input type="password" name="password" class="form-control">
						<span class="help-block"><?php echo $password_err; ?></span>
					</div>
					<div class="form-group">
<!--						<input type="submit" class="wbutton" value="Login Now">--> 
<!--						<button class="wbutton g-recaptcha" data-sitekey="6Lfs0K0UAAAAAD7LXLOywO8aVl0LqI5_So7UvQd4" data-callback='Login Now'>Submit</button>-->
						<button class="wbutton" id="loginForm1Button">Login Now</button>
					</div>
				</form>