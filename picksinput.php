<?php

session_start();

require_once('pdo_connect.php');

//skip sql query before data is entered

if (empty($_POST['pick_1'])) {
	} else {

		//make sure all picks have been entered

		if (!empty($_POST['pick_1']) && !empty($_POST['pick_2']) && !empty($_POST['pick_3']) && 
		!empty($_POST['pick_4']) && !empty($_POST['pick_5'])) {

		//PDO prepared statement (MUST STILL INSERT WEEK VARIABLE TO DIVIDE PICKS BY WEEK)
		
		$submit = $conn->prepare("INSERT INTO player_picks (player_id, pick_1, pick_2, pick_3, pick_4, pick_5) 
								VALUES (:player_id, :pick_1, :pick_2, :pick_3, :pick_4, :pick_5)");
		$submit->BindParam(':pick_1', $_POST['pick_1']);
		$submit->BindParam(':pick_2', $_POST['pick_2']);
		$submit->BindParam(':pick_3', $_POST['pick_3']);
		$submit->BindParam(':pick_4', $_POST['pick_4']);
		$submit->BindParam(':pick_5', $_POST['pick_5']);
		$submit->BindParam(':player_id', $_SESSION['player_id']);
		
			//make sure statement executes correctly, then send to table with all player picks
		
			if ($submit->execute()) {
				header("Location: /weekly_picks_table.php");
			} else {
				echo "It seems like there was a problem submitting your picks.  Please try again.";
			}
		} else {
		echo "<p>Please Select 5 Teams</p>";
		}
	}

?>



<!DOCTYPE html>
<html>
<head>
</head>
<title>Week <?php echo "[]";?> Picks</title>
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

<h1>MAKE YOUR PICKS FOR WEEK <?php echo "[]";?></h1>




<form action="picksinput.php" method="post">

	<p>Pick #1</p><br>
	
	<p><select name="pick_1">'
	<option value="">-Select-</option>
	<?php 
	// query db to get list of teams available to pick for that week (must direct to new season schedule database)
		$query = $conn->prepare("SELECT pick_1 FROM player_picks");
		$query->execute();		
			while ($teamlist = $query->fetch(PDO::FETCH_ASSOC))
			{
	?>
	<!--will also need to update ['pick_1'] to match with new db query (for all 5 picks)-->
	<option value="<?php echo $teamlist['pick_1']; ?>"><?php echo $teamlist['pick_1']; ?></option>
	<?php 
	
			}
			
			
	?>
	</select></p><br>

	<p>Pick #2</p><br>

	<p><select name="pick_2">'
	<option value="">-Select-</option>
	<?php 
		$query = $conn->prepare("SELECT pick_2 FROM player_picks");
		$query->execute();		
			while ($teamlist = $query->fetch(PDO::FETCH_ASSOC))
			{
	?>
	
	<option value="<?php echo $teamlist['pick_2']; ?>"><?php echo $teamlist['pick_2']; ?></option>
	<?php 
	
			}
			
			
	?>
	</select></p><br>
	
	<p>Pick #3</p><br>

<p><select name="pick_3">'
	<option value="">-Select-</option>
	<?php 
		$query = $conn->prepare("SELECT pick_3 FROM player_picks");
		$query->execute();		
			while ($teamlist = $query->fetch(PDO::FETCH_ASSOC))
			{
	?>
	
	<option value="<?php echo $teamlist['pick_3']; ?>"><?php echo $teamlist['pick_3']; ?></option>
	<?php 
	
			}
			
			
	?>
	</select></p><br>
	
	<p>Pick #4</p><br>

	<p><select name="pick_4">'
	<option value="">-Select-</option>
	<?php 
		$query = $conn->prepare("SELECT pick_4 FROM player_picks");
		$query->execute();		
			while ($teamlist = $query->fetch(PDO::FETCH_ASSOC))
			{
	?>
	
	<option value="<?php echo $teamlist['pick_4']; ?>"><?php echo $teamlist['pick_4']; ?></option>
	<?php 
	
			}
			
			
	?>
	</select></p><br>
	
	<p>Pick #5</p><br>

	<p><select name="pick_5">'
	<option value="">-Select-</option>
	<?php 
		$query = $conn->prepare("SELECT pick_5 FROM player_picks");
		$query->execute();		
			while ($teamlist = $query->fetch(PDO::FETCH_ASSOC))
			{
	?>
	
	<option value="<?php echo $teamlist['pick_5']; ?>"><?php echo $teamlist['pick_5']; ?></option>
	<?php 
	
			}
			
			
	?>
	</select></p><br>

	
	<p><input type="submit" name="submit" value="Submit Your Picks"></p>
	</form>
</body>
	
	



</html>