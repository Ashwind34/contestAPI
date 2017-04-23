<!DOCTYPE html>
<html>
<body>
<p style=text-align:center; color:blue;>Your picks for week [] have been submitted!</p>
<p style=text-align:center;><a href="index.php">Return to Home Page</a></p>

</body>
<?php 

require_once ('pdo_connect.php');

$datemarker = 0;

//problem starts here.  need to learn to join rows from both test tables, then submit to array, then debug while loop below

$query=$conn->prepare("SELECT 
						player_id, 
						user_name, 
						fav_team
						FROM player_roster"); 
						/*player_picks.player_id,
						player_picks.pick_1,
						player_picks.pick_2,
						player_picks.pick_3,
						player_picks.pick_4,
						player_picks.pick_5,
						player_picks.pick_1_week,
						player_picks.time_entered");*/
						
						
$query->execute();

$data=$query->fetch(PDO::FETCH_ASSOC);

//echo $data;

if (count($data) > 0) {
	
//this all works fine	
		
		echo '<table align="center" cellspacing="5" cellpadding="8">
		
		<tr><td align="center">Player</td>
		<td align="center">Favorite Team</td>
		<td align="center">Pick #1</td>
		<td align="center">Pick #2</td>
		<td align="center">Pick #3</td>
		<td align="center">Pick #4</td>
		<td align="center">Pick #5</td>
		<td align="center">Time of Entry</td></tr>';
		
		//code breaks down here - something wrong with $row syntax
		
		while ($row=$data) {
		
			echo '<tr><td align="center">' . $row['user.name'] . '</td>
			<td align="center">' . $row['fav.team'] . '</td>
			<td align="center">' . $row['pick_1'] . '</td>
			<td align="center">' . $row['pick_2'] . '</td>
			<td align="center">' . $row['pick_3'] . '</td>
			<td align="center">' . $row['pick_4'] . '</td>
			<td align="center">' . $row['pick_5'] . '</td>
			<td align="center">' . $row['time_entered'] . '</td></tr></table>';
			
		} 
		
	} else {
			echo "query problem";
	}
			
	
	
					


?>
</body>
</html>
