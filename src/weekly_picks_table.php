<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
<?php 

session_start();

require_once('datecheck.php');
require_once('pdo_connect.php');
require_once('picks_query.php');

//if we are before approx. 11:30 AM PST on Sunday, show logged-in player's picks only.  Else show all player's picks.

if ($kickoff_marker > 0.22) {
	
	echo '<h1 style=text-align:center; color:red;>Your Picks for Week ' . $weekmarker . '</h1>
			<p style=text-align:center;><a href="../index.php">Return to Home Page</a></p><br>';

	echo $player_picks_table;

	} else {
			
		echo '<h1 style=text-align:center; color:red;>Player Picks for Week ' . $weekmarker . '</h1>
				<p style=text-align:center;><a href="../index.php">Return to Home Page</a></p><br>';
	
		echo $weekly_picks_table;

		}		
?>
</body>
</html>
