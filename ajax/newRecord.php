<html>
<head>
<style type="text/css">
@media screen and (min-width: 1530px) {
	#d2 {
		display: inline-block;
		border: 2px solid #000000;
		width: 400px;
		height: 150px;
		margin: auto;  
		position: absolute;
		left:0;
		right: 0;
		top: 40px;
		bottom: 0;
		padding: 15px;
		border-radius: 10px;
	}
}
@media screen and (max-width: 1530px) {
	#d2 {
		display: inline-block;
		border: 2px solid #000000;
		width: 400px;
		height: 150px;
		margin: 185px auto 0px auto;  
		position: absolute;
		left:0;
		right: 0;
		top: 40px;
		bottom: 0;
		padding: 15px;
		font-weight: bold;
		border-radius: 10px;
	}
}
	#primarySave {
		background-color: #ccffcc;
	}
	#resetAll {
		background-color: #ffcccc;
	}
	input, select {
		border-radius: 2px;
    	border: 1px solid;
    	background-color: transparent;
	}
</style>
<script type="text/javascript">
		$('body').on('click', '#primarySave', function(){
		$(document.body).css({ 'cursor': 'wait' });
		var formData= $('#newRecordForm').serialize();
		$.post('newRecordScript.php', formData, result);
		function result(data){
			$(document.body).css({ 'cursor': 'default' });
			$('#d2').html(data);
		}
	}); //Process primarySave end
</script>
</head>
<body>

	<form method="post" action="" id="newRecordForm">
		<label for="nrName">Title:</label>
			<input type="text" name="nrName" id="nrTitle">
		<br />
		<label for="nrContent">Content:</label>
			<input type="text" name="nrContent" id="nrContent">
		<br />
		<label for="nrPriority">Priority:</label>
		<select type="text" name="nrPriority" id="nrPrioritySelc">
			<option value="">Select</option>
			<option value="1">High</option>
			<option value="2">Medium</option>
			<option value="3">Low</option>
		</select>
		<br />
		<label for="nrComplete">Target Completion:</label>
			<input type="date" name="nrComplete" id="nrTarget">
	</form>
</body>
</html>