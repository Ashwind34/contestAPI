<?php

// TO-DOs
// WRITE OBJECT/FUNCTION FOR ID CHECK

session_start();

require_once('src/pdo_connect.php');

//check if user is logged in

if(isset($_SESSION['player_id'])) {

	header("Location: ./src/home.php");

}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>
			SuperContest 2019
		</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<meta name="viewport" content="width=device-width">
	</head>
	<body class="blackBack">
		<div class='homeContainer'>
			<div class='redHead'>
				TECMO 
			</div>
			<div class='whiteHead'>
				SUPERCONTEST 2019
			</div>
			<fieldset>
				<legend style='text-align:left'>Main Menu</legend>
					<a href="src/login.php">Login</a><br>
					<a href="src/register.php">Register</a><br>
					<a href="src/passreset.php">Change Password</a>
			</fieldset>	
		</div>
	</body>
</html>


