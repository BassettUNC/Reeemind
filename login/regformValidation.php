<style type="text/css">
@media screen and (max-width: 450px) and (max-height: 750px) {	
	#logininfo {
		top: unset;
	}
}
@media screen and (max-width: 800px) {	
	#logininfo {
		top: unset;
	}
}
</style>
<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
<h1 id="loginheading">Log In</h1> 
<h4>Are you a Robot? </h4>
<?php
		$username= $_POST['username'];
		$email= $_POST['email']; 
		$fname= $_POST['fname'];
		$tzone= $_POST['tzone'];
		$password= $_POST['password'];
		$cpassword= $_POST['confirm_password'];
		$recaptcha_err= $_POST['recaptcha_err'];
		$agreementCheck_err= $_POST['agreementCheck_err'];		
?>		
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="validation">
	<div class="g-recaptcha" data-sitekey="6LeDB64UAAAAAGe2oJU2hGnvfTshO907Qz8ZVrUH"></div> 
	<span class="help-block"><?php echo $recaptcha_err; ?></span>
	<input type="checkbox" name="agreementCheck" value="agreementCheck"> By clicking this Checkbox, I agree to Reeemind's <a class="aBold" href="https://www.reeemind.com/includes/privacy.php">Privacy Policy</a> and <a class="aBold" href="../includes/tos.php">Terms of Serivce.</a> Furthermore, I agree that I am at least 13 years of age.
	<span class="help-block"><?php echo $agreementCheck_err; ?></span>
	<input type="hidden" name="verifyResponse" id="verifyResponse" class="form-control" value='false'>
	<input type="hidden" name="email" id="email" class="form-control" value="<?php echo $email; ?>" >
	<input type="hidden" name="fname" id="fname" class="form-control" value="<?php echo $fname; ?>">
	<input type="hidden" name="tzone" id="tzone" class="form-control" value="<?php echo $tzone; ?>">
	<input type="hidden" name="username" class="form-control" value="<?php echo $username; ?>">
	<input type="hidden" name="password" class="form-control" value="<?php echo $password; ?>">
	<input type="hidden" name="confirm_password" class="form-control" value="<?php echo $cpassword; ?>">
</form>
<button class="wbutton" id="loginsubmit1">Continue</button>
