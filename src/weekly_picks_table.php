<?php

require_once('datecheck.php');
require_once('pdo_connect.php');
require_once('picks_query.php');
			
session_start();

if(empty($_SESSION['player_id'])) {

	header("Location: ./login.php");

}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<div class="picksContainer">

			<?php 	

			//if we are before approx. 11:30 AM PST on Sunday, show logged-in player's picks only.  Else show all player's picks.

			if ($kickoff_marker > 0.22) {
				echo '<div class="formTitle">Your Picks for <br>Week ' . $weekmarker . '</div>
						<a class="formLink" href="../index.php">Return to Home Page</a>';

				echo $player_picks_table;
				
			} else {
				echo '<div class="formTitle">All Picks for <br>Week ' . $weekmarker . '</div>
						<a class ="formLink" href="../index.php">Return to Home Page</a>';
				
				echo $weekly_picks_table;
				
			}
			
			?>
		</div>
	</body>
</html>
