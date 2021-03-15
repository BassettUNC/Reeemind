<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<script type="text/javascript" src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
<?php
//Google Recaptcha
	if ($_POST['verifyResponse'] == 'false'){
		if(isset($_POST['g-recaptcha-response'])){
			$captcha=$_POST['g-recaptcha-response'];
		}
		else
			$captcha = false;
	
		if(!$captcha){
		//Issue with service
			//log issue
			$remote = $_SERVER['REMOTE_ADDR'];
			$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
			$page = 'regFormScript';
			$message = "Issue with recaptcha service.";
			$timestamp =  time();
			$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('iwrs', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
			$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
	//		echo 'There has been an issue with the reCAPTCHA service. Please try again.';	
			?>				
			<script type="text/javascript">
				var formData= $('#required, #optional').serialize();
				$.post('regformValidation.php', formData, result);
				function result(data){
					$(document.body).css({ 'cursor': 'default' });
					$('#logininfo').html(data);
				}
			; //repost login validation form end	
		</script>
		<?php
				$captcha_err = "To Continue, you must complete the reCAPTCHA.<br />";
		}
		else{
			$privatekey = '6LeDB64UAAAAAMKcn0Xb-qApWDDzs4rTyMBIHrXq';
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
				echo 'ERROR 1: The people at google think you\'re a robot. If you aren\'t, pleast try again or try a different browser.';
				//log issue
				$remote = $_SERVER['REMOTE_ADDR'];
				$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
				$page = 'regFormScript';
				$message = "User is likley non-human.";
				$timestamp =  time();
				$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('ulnh', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
				$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
				die ();
				}
		} // If user isn't a robot, continue.	
		if(isset($_POST['agreementCheck'])){
			$agreementCheck=$_POST['agreementCheck'];
		}
		else {
			?>	
				<script type="text/javascript">
					var formData= $('#required, #optional').serialize();
					$.post('regformValidation.php', formData, result);
					function result(data){
						$(document.body).css({ 'cursor': 'default' });
						$('#logininfo').html(data);
					}
				; //repost login validation form end	
			</script>
			<?php
				$agreementCheck_err = '<br />To continue, you must agree to the directly aforementioned statement.';
		}
	}
	$verifyResponse= true;
// Include config file
require_once "../includes/dbConnect.php";
include("../../etc/reeemind.com/tax/taxes.php");
$usertable= 'users'; 

// Define variables and initialize with empty values
	$username= $_POST['username'];
	$email= $_POST['email']; 
	$fname= $_POST['fname'];
	$tzone= $_POST['tzone'];
	$password= $_POST['password'];
	$enonce= '';
	$fnonce= '';
	$tnonce= '';
	$time= time();
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT UID FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Error 3: Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
	
		//Encrypt if not empty
		if (!empty($email)) {
			$enonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
			$param_email = sodium_crypto_secretbox("$email", $enonce, $key);
		} else {
			$param_email = $email;
		}
		if (!empty($fname)) {
			$fnonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
			$param_fname = sodium_crypto_secretbox("$fname", $fnonce, $key);
		} else {
			$param_fname = $fname;
		}
		if (!empty($tzone)) {
			$tnonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
			$param_tzone = sodium_crypto_secretbox("$tzone", $tnonce, $key);
		} else {
			$param_tzone = $tzone;
		}	
			    
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, email, emailnonce, fname, fnamenonce, tzone, tzonenonce, createdAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_username, $param_password, $param_email, $enonce, $param_fname, $fnonce, $param_tzone, $tnonce, $time);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
						
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				//log action
				$remote = $_SERVER['REMOTE_ADDR'];
				$forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
				$page = 'regFormScript';
				$message = "Registration successful.";
				$timestamp =  time();
				$query = "INSERT INTO log (UID, Page, Message, Timestamp, Remote, Forwarded) VALUES ('un.$username', '$page', '$message', '$timestamp', '$remote', '$forwarded')";
				$result = mysqli_query($conn, $query) or die ("Error writing to DB. usertable= $usertable" . mysqli_error($conn));
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Error 2: Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
<html>
<head>
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
					<h1>Create An Account</h1>
				</div>
			</div> <!-- end mheading div -->
			<div id ="rheading">
				<div class="vcentertext">				</div>
			</div> 
			<!-- end rheading div -->
		</div> <!-- end heading div -->
		<div id="orangel">
			<div id="logininfo">
				<!-- <h1 id="loginheading">Sign Up</h1> -->
					<div id ="lheading">
						<div class="vcentertext">
						<h1 class="sectiontitle">Required</h1>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="required">
								<input type="hidden" name="g-recaptcha-response" value="<?php echo $captcha; ?>">
								<input type="hidden" name="recaptcha_err" value="<?php echo $captcha_err; ?>">
								<input type="hidden" name="agreementCheck_err" value="<?php echo $agreementCheck_err; ?>">
								<input type="hidden" name="verifyResponse" value="<?php echo $verifyResponse; ?>">
								<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
									<label>Username</label>
									<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
									<span class="help-block"><?php echo $username_err; ?></span>
								</div>    
								<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
									<label>Password</label>
									<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
									<span class="help-block"><?php echo $password_err; ?></span>
								</div>
								<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
									<label>Confirm Password</label>
									<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
									<span class="help-block"><?php echo $confirm_password_err; ?></span>
								</div>
							</form>
						</div> <!-- end vcentertext div -->
					</div> <!-- end lheading div -->
					<div id ="mheading" class="mheadingsep">
						<div class="vcentertext">
							<button class="wbutton" id="loginsubmit2">Lets GO! </button>
							<h4 id="regMessage">*If you do not provide an email, you will not be able to reset your account </h4>
						</div> <!-- vcentertext div -->
					</div> <!-- end mheading div -->
					<div id ="rheading">
						<div class="vcentertext">
						<h1>Optional</h1>						
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="optional">
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
								</div>
								<div class="form-group">
									<label>First Name</label>
									<input type="text" name="fname" id="fname" class="form-control" value="<?php echo $fname; ?>">
								</div>
								<div class="form-group">
									<label>Time Zone</label>
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
										print '<select name="tzone" id="tzone" class="form-control">';
										foreach($timezones as $region => $list)
										{
											print '<optgroup label="' . $region . '">' . "\n";
											foreach($list as $timezone => $name)
											{
												$name1 = str_replace("_"," ",$name);
												print '<option name="' . $timezone . '" value="' . $timezone . '">' . $name1 . '</option>' . "\n";
											}
											print '<optgroup>' . "\n";
										}
										print '</select>';
										?>								
								</div>
								</div>
							</form>
						</div> <!-- end vcentertext div -->
					</div> 
					<!-- end rheading div -->
			</div> <!-- end logininfo div -->
		</div> <!-- end oragne1 div -->	
		<div id="bluel">
			<div class="socialmedia">
				<h1>If Assistance is Desired</h1>
				<div class="socialmediaicon">
					<a href="twitter.com"><img src="../media/twitter.png" height="47px" class="socialmediaicons"/></a>
					<a href="twitter.com"><img src="../media/email.png" height="47px" class="socialmediaicon"/></a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>	
