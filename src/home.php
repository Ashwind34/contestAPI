<?php

session_start();

require_once('pdo_connect.php');
require_once('picks_query.php');
require_once('datecheck.php');

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
} else {    
    header("Location: ./login.php");
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>
			SuperContest 2019
		</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
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
					Hello<?php echo " $user[first_name]";?>
				</div>
				<fieldset>
					<legend>Main Menu</legend>		
						<a href="picksinput.php">Make Your Picks</a>
						<a href="weekly_lines_table.php">Weekly Schedule</a>
						<a href="weekly_picks_table.php">Current Picks</a>
						<a href="leaderboard.php">Leaderboard</a>
						<a href="passreset.php">Change Password</a>
						<a href="logout.php">Logout</a>

						<!-- Allow link to admin menu for specific users -->
						
						<?php                     
						if ($user['player_id'] == 1 OR $user['player_id'] == 2) {
							
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


