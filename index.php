<?php

// TO-DOs
// WRITE OBJECT/FUNCTION FOR ID CHECK
// ADD CSS FILE


session_start();

require_once('src/pdo_connect.php');
require_once('src/picks_query.php');
require_once('src/datecheck.php');

//check if user is logged in

if(isset($_SESSION['player_id'])) {
	
	//PDO prepared statement
	$record = $conn->prepare("SELECT player_id, first_name FROM player_roster WHERE player_id = :id"); 
	$record->bindParam(':id',$_SESSION['player_id']);
	$record->execute();
	
	//create associative array from query
	$result = $record->fetch(PDO::FETCH_ASSOC);
	$user = '';
	
	//set $user as array that contains query data
	if (COUNT($result) > 0 ) {
		$user = $result;
	} else {
		die("No result returned");
	}
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

	<body>
		<div class='homeContainer'>
			<div class='redHead'>
				TECMO 
			</div>
			<div class='whiteHead'>
				SUPERCONTEST 2019
			</div>
			<div class="body">
				Hello<?php echo " $user[first_name]";?>
			</div>
			<fieldset>
				<legend style='text-align:left'>Main Menu</legend>		

				<!--only shows login links if user is not logged in-->

				<?php 
					if (empty($user)) {
						echo 
						'<a href="src/login.php">Login</a><br>
						<a href="src/register.php">Register</a><br>
						<a href="src/passreset.php">Change Password</a>';

					} else {
						echo 
						'<a href="src/picksinput.php">Submit Your Picks</a><br>
						<a href="src/weekly_lines_table.php">Schedule</a><br>
						<a href="src/weekly_picks_table.php">Picks Table</a><br>
						<a href="src/leaderboard.php">Leaderboard</a><br>
						<a href="src/passreset.php">Change Password</a><br>
						<a href="src/logout.php">Logout</a><br>';

						// Allow link to admin menu for specific users
						
						if ($user['player_id'] == 1 OR $user['player_id'] == 2) {
							
							echo'<a href="src/admin.php"><i>Admin Page</i></a>';
							
						} 
					}				
				?>
			</fieldset>	
		</div>
	</body>
</html>


