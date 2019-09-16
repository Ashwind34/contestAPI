<?php

require_once('sessioncheck.php');

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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
	</head>
	<body>
		<div class="wrapper">
			<div class="adminContainer">
				<div class="whiteHead">
					ADMIN
				</div>
				<div>
					<p>Current Date: <?php echo $today_date ?></p>
				</div>
				<fieldset>				
					<a href="schedule_updater.php">Update Lines and Scores</a><br>
					<a href="all_picks.php">All Current Picks</a><br>
					<a href="pinresetall.php">Reset Player PINs</a><br>
					<a href="reminders.php">Send Email Reminders</a><br>
					<a href="home.php">Back to Homepage</a><br>
					<a href="phpinfo.php">PHP Info</a><br>
				</fieldset>			
			</div>
		</div>
	</body>
</html>