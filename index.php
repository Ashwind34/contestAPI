<?php

session_start();

require_once('contest/pdo_connect.php');
require_once('contest/datecheck.php');
require_once('contest/picks_query.php');

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
	SuperContest 2017
</title>
<!--<link rel="stylesheet" type="text/css" href="style.css">-->
<style>
	h1{color:green;}
	h2{color:black;}
	p {color:blue; text-align:center;}
<<<<<<< HEAD
	
	
	
</style>
<meta name="viewport" content="width=device-width">
=======
	body {background-color:grey;}
	
	
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
>>>>>>> 2aa6d7ca75aed135284ce6158a746dceb3517302
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
		<p><a href="contest/login.php">Click Here to Login</a></p>
		<br>
		<br>
		<p><a href="contest/register.php">Click Here to Register</a></p>
		<br>
		<br>
		';
	} else {
		echo '<br>
		<br><p><a href="contest/picksinput.php">Submit Your Picks</a></p>
		<br>
		<br>
		<p><a href="contest/weekly_lines_table.php">Weekly Schedule</a></p>
		<br>
		<br>
		<p><a href="contest/weekly_picks_table.php">Contest Picks</a></p>
		<br>
		<br>
		<p><a href="contest/leaderboard.php">Leaderboard</a></p>
		<br>
		<br>			
		<p><a href="contest/logout.php">Logout</a></p>
		<br>
<<<<<<< HEAD
		<br>';
		
		if ($user['player_id'] == 1 OR $user['player_id'] == 2) {
			
			echo'<p><a href="contest/schedule_updater.php"><i>Update Lines and Scores</i></a></p><br>';
			echo'<p><a href="contest/regtest1.php">Reg Test</a></p>';
=======
		<br>
		';
		
		if ($user['player_id'] == 1 OR $user['player_id'] == 2) {
			
			echo'<p><a href="contest/schedule_updater.php"><i>Update Lines and Scores</i></a></p>';
>>>>>>> 2aa6d7ca75aed135284ce6158a746dceb3517302
			
		} else {} 
	}
	
			
			
		?>



</body>
</html>


