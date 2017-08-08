<?php

session_start();

require_once('pdo_connect.php');
require_once('datecheck.php');
require_once('player_picks_query.php');

if( isset($_SESSION['player_id'])) {
	
	//PDO prepared statement
	$record = $conn->prepare("SELECT player_id, first_name FROM player_roster WHERE player_id = :id"); 
	$record->bindParam(':id',$_SESSION['player_id']);
	$record->execute();
	
	//create associative array from query
	$result = $record->fetch(PDO::FETCH_ASSOC);
	
	
	//set $user as array that contains query data
	if (COUNT($result) > 0 ) {
	$user = $result;
	} else {
		die("No result returned");
}
}


//skip sql query before data is entered

if (empty($_POST['submit'])) {
	} else {

		//make sure that all picks are filled
	
		/*if(!empty($_POST['pick_1']) && !empty($_POST['pick_2']) && !empty($_POST['pick_3']) && !empty($_POST['pick_4']) 
		&& !empty($_POST['pick_5'])) {*/
	
			//PDO prepared statement 
			
			$submit = $conn->prepare("INSERT INTO player_picks (player_id, pick_1, pick_2, pick_3, pick_4, pick_5, week) 
									VALUES (:player_id, :pick_1, :pick_2, :pick_3, :pick_4, :pick_5, :weekmarker)");
			$submit->BindParam(':pick_1', $_POST['pick_1']);
			$submit->BindParam(':pick_2', $_POST['pick_2']);
			$submit->BindParam(':pick_3', $_POST['pick_3']);
			$submit->BindParam(':pick_4', $_POST['pick_4']);
			$submit->BindParam(':pick_5', $_POST['pick_5']);
			$submit->BindParam(':player_id', $_SESSION['player_id']);
			$submit->BindParam(':weekmarker', $weekmarker);
			
				//make sure statement executes correctly, then send to table with all player picks
			
				if ($submit->execute()) {
					header("Location: /weekly_picks_table.php");
				} else {
					echo "It seems like there was a problem submitting your picks.  Please try again.";
				}
			
			} /*else {
				echo '<p style=text-align:center><b>Please select 5 teams!</b></p><br>';
				echo '<p style=text-align:center><a href="picksinput.php">Try Again</a></p><br>';
				echo '<p style=text-align:center><a href="index.php">Return to Home Page</a></p>';
				exit();
				
			
			}
	}*/
			
	
	
?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<title>Week <?php echo $weekmarker;?> Picks</title>
<body>

<style>

h1 {
	text-align:center;
	color:red;
}

p {
	text-align:center;
	color:green;
}

</style>

<h1>Make your picks for Week <?php echo "$weekmarker, $user[first_name]";?>!</h1>




<form action="picksinput.php" method="post">


	<p>Pick #1</p>
	
	<p><?php PickDropdown($pick_1, $conn, 'pick_1', $weekmarker, $date); ?></p>
	
	<p>Pick #2</p>

	<p><?php PickDropdown($pick_2, $conn, 'pick_2', $weekmarker, $date); ?></p>
	
	<p>Pick #3</p>

	<p><?php PickDropdown($pick_3, $conn, 'pick_3', $weekmarker, $date); ?></p>
		
	<p>Pick #4</p>

	<p><?php PickDropdown($pick_4, $conn, 'pick_4', $weekmarker, $date); ?></p>
	
	<p>Pick #5</p>

	<p><?php PickDropdown($pick_5, $conn, 'pick_5', $weekmarker, $date); ?></p>

	
	<p><input type="submit" name="submit" value="Submit Your Picks"></p>
	</form>
</body>
	
	



</html>