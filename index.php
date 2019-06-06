<?php

// TO-DOs
// WRITE OBJECT/FUNCTION FOR ID CHECK
// ADD CSS FILE


session_start();

require_once('src/pdo_connect.php');
//require_once('src/datecheck.php');
require_once('src/picks_query.php');

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
	<!--<link rel="stylesheet" type="text/css" href="style.css">-->
		<style>
			h1{color:green;}
			h2{color:black;}
			p {color:blue; text-align:center;}		
		</style>
		<meta name="viewport" content="width=device-width">
	</head>

	<body>
		<h1 style="text-align:center;">WELCOME TO THE 2019 NFL SUPERCONTEST</h1>
		<h2 style="text-align:center;"><i>Brought to you by Jay and Beaks</i></h2>
		<p><b>THIS IS A WORK IN PROGRESS</b></p>
		<p><b>Hello<?php echo " $user[first_name]";?>!</p>

	<!--only shows login links if user is not logged in-->

	<?php 
		if (empty($user)) {
			echo 
			'<br>
			<p><a href="src/login.php">Click Here to Login</a></p>
			<br>
			<br>
			<p><a href="src/register.php">Click Here to Register</a></p>
			<br>
			<br>
			<p><a href="src/pinresetfresh.php">Click Here to Reset your PIN</a></p>';
		} else {
			echo 
			'<br>
			<br><p><a href="src/picksinput.php">Submit Your Picks</a></p>
			<br>
			<br>
			<p><a href="src/weekly_lines_table.php">Weekly Schedule</a></p>
			<br>
			<br>
			<p><a href="src/weekly_picks_table.php">Contest Picks</a></p>
			<br>
			<br>
			<p><a href="src/leaderboard.php">Leaderboard</a></p>
			<br>
			<br>	
			<p><a href="src/pinreset.php">Click Here to Reset your PIN</a></p>
			<br>
			<br>		
			<p><a href="src/logout.php">Logout</a></p>
			<br>
			<br>';

			// Allow link to admin menu for specific users
			
			if ($user['player_id'] == 1 OR $user['player_id'] == 2) {
				
				echo'<p><a href="src/admin.php"><i>Admin Page</i></a></p><br>';
				
			} 
		}				
	?>
	</body>
</html>


