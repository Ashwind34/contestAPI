<!DOCTYPE html>
<html>
<body>
<?php 

require_once('datecheck.php');
require_once('pdo_connect.php');

?>

<p style=text-align:center; color:blue;>Your picks for week <?php echo $weekmarker; ?> have been submitted!</p>
<p style=text-align:center;><a href="index.php">Return to Home Page</a></p>

</body>
<?php 


$datemarker = 0;
//need to fill this in with a function from another file

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
//query for all picks on record - MUST LIMIT BY WEEK


$data=$query->fetchall(PDO::FETCH_ASSOC);
//create array - data to be displayed in weekly picks table below.  Will need to limit by pick_1_week





if (count($data) > 0) {
	
//Make sure	query array is not empty, then create html table with all entries
		
		echo '<table align="center" border="1" cellspacing="5" cellpadding="8">
		
		<tr><th align="center">Player</th>
		<th align="center">Favorite Team</th>
		<th align="center">Pick #1</th>
		<th align="center">Pick #2</th>
		<th align="center">Pick #3</th>
		<th align="center">Pick #4</th>
		<th align="center">Pick #5</th>
		<th align="center">Time of Entry</th></tr>';
		
	// foreach loop to list out each row in the array	
		
		foreach ($data as $row) {
			
				
			echo 
			'<tr><td align="center">' . $row['user_name'] . '</td>
			<td align="center">' . $row['fav_team'] . '</td>
			<td align="center">' . $row['pick_1'] . '</td>
			<td align="center">' . $row['pick_2'] . '</td>
			<td align="center">' . $row['pick_3'] . '</td>
			<td align="center">' . $row['pick_4'] . '</td>
			<td align="center">' . $row['pick_5'] . '</td>
			<td align="center">' . $row['time_entered'] . '</td>';
			echo '</tr>';
			
			
		} 
		
		
		echo  '</table>';
		
	} else {
			echo "query problem";
	
			


		}		
?>
</body>
</html>
