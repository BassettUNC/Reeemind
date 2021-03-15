<html>
<head>
<title>Reeemind</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link rel="shortcut icon" type="image/png" href="../includes/favicon.png"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&display=swap" />
<link rel="stylesheet" href="../includes/style.css" />
<link rel="stylesheet" href="../includes/3barStyle.css" />
<head>
<meta charset="UTF-8">
<title>Reeemind</title>
<style type="text/css">
	#mheading {
		width: 283px;
		}
	#logininfo {
		width: 94.5%;
		}
	#lheading {
		display:unset;
		left: 4%;
	}
	#rheading {
		right: 7%;
	}
	.sectiontitle {
		margin-bottom: 6px;
	}
	#regMessage {
		margin: 10px 15px;
	}
@media screen and (max-width: 800px) {	
	body {
		overflow:hidden;
	}
	#redl {
		height: 10%;
	}
	#orangel {
		height: 73%;
	}
	#bluel {
	}
	#lheading {
		transform: translateY(-390px);
		margin: 0 auto;
		left: unset;
	}
	#rheading {
		float:none;
		margin: 0 auto;
		transform: translateY(-65px);
		position: unset;
		width: 240px;
	}
	.mheadingsep {
		transform: translateY(95px);
	}
	.socialmedia {
		top: 92%;
		bottom:0%;
	}
	.vcentertext {
		margin: unset;
		position: unset;
		top: unset;
		transform: unset;
	}
	#logininfo {
		margin:unset;
	}
}
@media screen and (max-width: 450px) {	
	body {
		overflow:hidden;
	}
	#redl {
		height: 10%;
	}
	#orangel {
		height: 73%;
	}
	#bluel {
	}
	#lheading {
		transform: translateY(-390px);
		margin: 0 auto;
		left: unset;
	}
	#rheading {
		float:none;
		margin: 0 auto;
		transform: translateY(-65px);
		position: unset;
		width: 240px;
	}
	.mheadingsep {
		transform: translateY(95px);
	}
	.socialmedia {
		top: 92%;
		bottom:0%;
		width: 250px;
	}
	.vcentertext {
		margin: unset;
		position: unset;
		top: unset;
		transform: unset;
	}
	#logininfo {
		margin:unset;
	}
}
@media screen and (max-width: 450px) and (max-height: 750px) {	
	body {
		overflow:unset;
	}
	#wrapper {
		overflow:unset;
	}
	#redl {
		height: 75px;
	}
	#orangel {
		height: 547.5px;
	}
	#bluel {
		height: 180px;
	}
	#lheading {
		transform: translateY(-390px);
		margin: 0 auto;
		left: unset;
	}
	#rheading {
		float:none;
		margin: 0 auto;
		transform: translateY(-65px);
		position: unset;
		width: 240px;
	}
	.mheadingsep {
		transform: translateY(95px);
	}
	.socialmedia {
		top: unset;
		bottom: unset;
		width: 250px;
	}
	.vcentertext {
		margin: unset;
		position: unset;
		top: unset;
		transform: unset;
	}
	#logininfo {
		margin:unset;
		margin-top: 270px;
		top: unset;
		bottom: unset;
	}
	.mhidden {
		display: none;
	}
}
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function()  {
		$('body').on('click', '#loginsubmit', function(){
		$(document.body).css({ 'cursor': 'wait' });
		var formData= $('#required, #optional').serialize();
		$.post('regformValidation.php', formData, result);
		function result(data){
			$(document.body).css({ 'cursor': 'default' });
			$('#logininfo').html(data);
		}
	}); //Process login forms end
		$('body').on('click', '#loginsubmit1', function(){
		$(document.body).css({ 'cursor': 'wait' });
		var formData= $('#validation').serialize();
		$.post('regformscript.php', formData, result);
		function result(data){
			$(document.body).css({ 'cursor': 'default' });
			$('#wrapper').html(data);
		}
	}); //Process hidden login validation form end
		$('body').on('click', '#loginsubmit2', function(){
		$(document.body).css({ 'cursor': 'wait' });
		var formData= $('#required, #optional').serialize();
		$.post('regformscript.php', formData, result);
		function result(data){
			$(document.body).css({ 'cursor': 'default' });
			$('#wrapper').html(data);
		}
	}); //Process login forms (in regformscript) end
});  //  end document ready
</script>
</head>
<body>
	<div id="wrapper">
		<div id="topbar">
			<div id="topbartext">		
				<a href="http://www.reeemind.com"><h4 class="blackbartext">Reeemind</h4></a>			
			</div>
		</div>
		<div id="redl">
			<div id ="lheading">
				<div class="vcentertext">
				</div>
			</div> <!-- end lheading div -->
			<div id ="mheading">
				<div class="vcentertext2">
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
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control">
								</div>    
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control">
								</div>
								<div class="form-group">
									<label>Confirm Password</label>
									<input type="password" name="confirm_password" class="form-control">
								</div>
							</form>
						</div> <!-- end vcentertext div -->
					</div> <!-- end lheading div -->
					<div id ="mheading" class="mheadingsep">
						<div class="vcentertext">
							<button class="wbutton" id="loginsubmit">Create Account</button>
							<h4 id="regMessage">*If you do not provide an email, you will not be able to reset your account </h4>
						</div> <!-- vcentertext div -->
					</div> <!-- end mheading div -->
					<div id ="rheading">
						<div class="vcentertext">
						<h1>Optional</h1>						
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="optional">
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" id="email" class="form-control">
								</div>
								<div class="form-group">
									<label>First Name</label>
									<input type="text" name="fname" id="fname" class="form-control">
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
