<?php

session_start();

require_once('datecheck.php');
require_once('pdo_connect.php');

if(!adminCheck()) {
	header("Location: ./login.php");
}

?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Admin
		</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<style>
			h1{color:green;}
			h2{color:black;}
			p {color:blue; text-align:center;}
		</style>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>				
		<p><a href="schedule_updater.php"><i>Update Lines and Scores</i></a></p><br>
		<p><a href="pinresetall.php">Reset Player PIN</a></p><br>
		<p><a href="../index.php">Back to Homepage</a></p>
		<p><a href="functioncheck.php">Check Functions</a></p>
		<p>Current Date: <?php echo $today_date ?></p><br>
		<p>Beta Test Date: <?php echo $fake_date ?></p><br>
	</body>
</html>