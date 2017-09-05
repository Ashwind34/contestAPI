<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
<?php 

require_once('datecheck.php');
require_once('pdo_connect.php');
require_once('weekly_picks_query.php');

?>

<p style=text-align:center; color:blue;>Your picks for week <?php echo $weekmarker; ?> have been submitted!</p>
<p style=text-align:center;><a href="index.php">Return to Home Page</a></p>

</body>
<?php 

//create array - data to be displayed in weekly picks table below.

$data=$picks_table->fetchall(PDO::FETCH_ASSOC);
  
//Make sure	query array is not empty, then create html table with all entries
//MUST SET THIS TO ONLY SHOW AFTER SUNDAY MORNING GAMES HAVE STARTED, SHOW LOGGED-IN PLAYER'S PICKS BEFORE THEN
  
if (count($data) > 0) {
	
		
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
