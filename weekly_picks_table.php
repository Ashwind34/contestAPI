<!DOCTYPE html>
<html>
<body>
<p style=text-align:center; color:blue;>Your picks for week [] have been submitted!</p>
<p style=text-align:center;><a href="index.php">Return to Home Page</a></p>

</body>
<?php 

require_once ('pdo_connect.php');

$datemarker = 0;

//create array - data to be displayed in weekly picks table below.  Will need to limit by pick_1_week

$query=$conn->prepare("SELECT
						 
						player_roster.user_name, 
						player_roster.fav_team,						 
						player_picks.pick_1,
						player_picks.pick_2,
						player_picks.pick_3,
						player_picks.pick_4,
						player_picks.pick_5,
						player_picks.pick_1_week,
						player_picks.time_entered
                        FROM 
                        player_roster JOIN player_picks ON
                        player_roster.player_id = player_picks.player_id");
						
						
$query->execute();

$data=$query->fetch(PDO::FETCH_ASSOC);


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
		
		/*code breaks down here - something wrong with $row syntax - first row in join prints normal, then continually prints same row 
		over and over, does not stop.  Must find a way to display all rows and end while loop after final row*/
		
		while ($row=$data) {
		
			echo '<tr><td align="center">' . $row['user_name'] . '</td>
			<td align="center">' . $row['fav_team'] . '</td>
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
