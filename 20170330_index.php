<?php

session_start();

require_once('pdo_connect.php');

if( isset($_SESSION['player_id'])) {
	
	$record = $conn->prepare("SELECT player_id, first_name FROM player_roster WHERE player_id = :id"); 
	$record->bindParam(':id',$_SESSION['player_id']);
	$record->execute();
	$result = $record->fetch(PDO::FETCH_ASSOC);
	$user = '';
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
<p
style="text-align:center;"><b>Hello <?php echo "$user[first_name]"; ?>!</p>
<br>
<a href="login.php">Click Here to Log In</a>
<br>
<br>
<a href="register.php">Click Here to Register</a>
<br>
<br>
<a href="user_table_test.php">Player Roster</a>
<br>
<br>
<a href="pdo_connect.php">PDO Test</a>
<br>
<br>
<a href="logout.php">Logout</a>

</body>
</html>


