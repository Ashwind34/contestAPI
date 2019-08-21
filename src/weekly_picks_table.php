<?php

require_once('sessioncheck.php');

setSession(basename(__FILE__));

require_once('datecheck.php');
require_once('picks_query.php');

sessionCheck("login.php");

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="preload" href="../css/img/tecmoTD.png" as="image">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body class="blackBack">
		<div class="wrapper">
			<div class="picksContainer">
				
				<?php 	

				//if we are before approx. 11:30 AM PST on Sunday, show logged-in player's picks only.  Else show all player's picks.
				// CURRENTLY DISABLED

				// if ($kickoff_marker > 0.22) {

					echo '<div class="formTitle">Your Picks for <br>Week ' . $weekmarker . '</div>';
					echo $player_picks_table;
					echo '<a class="formLink" href="home.php">Return to Home Page</a>';
					
				// } else {
				// 	echo '<div class="formTitle">All Picks for <br>Week ' . $weekmarker . '</div>
				// 			<a class ="formLink" href="../index.php">Return to Home Page</a>';
					
				// 	echo $weekly_picks_table;
					
				// }
				
				?>
				<div class="slide">
					<img class="boPic" src="../css/img/tecmoTD.png" alt="">
				</div>
			</div>
		</div>
	</body>
</html>
