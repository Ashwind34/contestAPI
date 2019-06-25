<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>

		<?php 

		session_start();

		require_once('datecheck.php');
		require_once('pdo_connect.php');
		require_once('picks_query.php');

		//if we are before approx. 11:30 AM PST on Sunday, show logged-in player's picks only.  Else show all player's picks.

		if ($kickoff_marker > 0.22) {
			echo '<p>Your Picks for Week ' . $weekmarker . '<p>
					<p><a href="../index.php">Return to Home Page</a></p><br>';

			echo $player_picks_table;
			
		} else {
			echo '<p>Player Picks for Week ' . $weekmarker . '</p>
					<p><a href="../index.php">Return to Home Page</a></p><br>';
			
			echo $weekly_picks_table;
			
		}
		
		?>
	
	</body>
</html>
