<?php

require_once('sessioncheck.php');

setSession(basename(__FILE__));

require_once('pdo_connect.php');
require_once('picks_query.php');
require_once('datecheck.php');

sessionCheck("login.php");

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>
			SuperContest 2019
		</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<meta name="viewport" content="width=device-width">
	</head>
	<body>
		<div class="wrapper">
			<div class='homeContainer'>
				<div class='redHead'>
					TECMO 
				</div>
				<div class='whiteHead'>
					SUPERCONTEST 2019
				</div>
				<div class="hello">
					Hello<?php echo " $player_name";?>
				</div>
				<fieldset>
					<legend>Main Menu</legend>		
						<a class = "noMargin" href="picksinput.php">Make Your Picks</a>
						<a href="weekly_lines_table.php">Weekly Schedule</a>
						<a href="weekly_picks_table.php">Current Picks</a>
						<a href="leaderboard.php">Leaderboard</a>
						<a href="payouts.php">Contest Prizes</a>
						<a href="passreset.php">Change Password</a>
						<a href="logout.php">Logout</a>

						<!-- Allow link to admin menu for specific users -->
						
						<?php                     
						if ($player_id == 1 || $player_id == 2) {
							
							echo'<a href="admin.php"><i>Admin Page</i></a>';
							
						} 
						?>
				</fieldset>
				<br>
				<br>
			</div>
		</div>
	</body>
</html>


