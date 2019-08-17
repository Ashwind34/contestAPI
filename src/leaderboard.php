<?php

require_once('sessioncheck.php');

setSession(basename(__FILE__));

require_once('leaderboardtable.php');

sessionCheck("login.php");

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- set page to eliminate data cache storage on reload -->
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body class="blackBack">
		<div class="boardContainer">
			<div class='formTitle'>
				LEADERBOARD<br>
				WEEK <?php echo $weekmarker; ?> 
			</div>
			<div class="formLink">
				<a class="noMargin" href="quarterboard.php">Quarterly Leaderboard</a>
				<a href="home.php">Return to Home Page</a>				
			</div>
			<div>			
				<?php echo $leaderboard; ?>				
			</div>
			<div>
				<a class="formLink" href="home.php">Return to Home Page</a>
				<br>
				<br>
			</div>
		</div>
	</body>
</html>
