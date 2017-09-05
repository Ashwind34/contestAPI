<?php

session_start();

require_once('pdo_connect.php');
require_once('datecheck.php');
require_once('player_picks_query.php');

//check if user is logged in

if( isset($_SESSION['player_id'])) {
	
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
	SuperContest 2017
</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
	h1{color:green;}
	h2{color:black;}
	p {color:blue; text-align:center;}
	body {background-color:grey;}
	
	
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h1  
style="text-align:center;">WELCOME TO THE 2017 NFL SUPERCONTEST</h1>
<h2
style="text-align:center;"><i>Brought to you by Jay and Beaks</i></h2>
<p><b>THIS IS A WORK IN PROGRESS</b></p>
<p>
<b>Hello<?php echo " $user[first_name]";?>!</p>


<!--only shows login links if user is not logged in-->

<?php 
	if (empty($user)) {
		echo '<br>
		<p><a href="login.php">Click Here to Login</a></p>
		<br>
		<br>
		<p><a href="register.php">Click Here to Register</a></p>
		<br>
		<br>
		';
	} else {
		echo '<br>
		<br><p><a href="picksinput.php">Submit Your Picks</a></p>
		<br>
		<br>
		<p><a href="weekly_lines_table.php">Weekly Schedule</a></p>
		<br>
		<br>
		<p><a href="leaderboard.php">Leaderboard</a></p>
		<br>
		<br>			
		<p><a href="logout.php">Logout</a></p>
		<br>
		<br>
		';
		
		if ($user['player_id'] == 1 OR $user['player_id'] == 2) {
			
			echo'<p><a href="schedule_updater.php"><i>Update Lines and Scores</i></a></p>';
			
		} else {} 
	}
	
			
			
		?>



</body>
</html>


