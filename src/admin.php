<?php

require_once('sessioncheck.php');

setSession(basename(__FILE__));

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
		<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<style>
			h1{color:green;}
			h2{color:black;}
			p {color:blue; text-align:center;}
		</style>
	</head>
	<body>				
		<p><a href="schedule_updater.php"><i>Update Lines and Scores</i></a></p><br>
		<p><a href="pinresetall.php">Reset Player PIN</a></p><br>
		<p><a href="home.php">Back to Homepage</a></p><br><br>
		<p><a href="functioncheck.php">Check Functions</a></p><br>
		<p><a href="phpinfo.php">PHP Info</a></p><br>

		<p>Current Date: <?php echo $today_date ?></p><br>
		<p>Beta Test Date: <?php echo $fake_date ?></p><br>
	</body>
</html>