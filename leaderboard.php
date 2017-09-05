<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- set page to eliminate data cache storage on reload -->
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<body>
<?php 

require_once('datecheck.php');
require_once('pdo_connect.php');


?>

<h1 style=text-align:center; color:blue;>LEADERBOARD</h1>
<p style=text-align:center;><a href="index.php">Return to Home Page</a></p>

</body>
<?php 

//NEED TO SOLVE PSCORE ISSUE AND THEN ADD PREVIOUS WEEKS SCORE TO $QUERY FOR TABLE
$query_last_week = "Week_$last_week";

$query = $conn->prepare("SELECT 
							
							CONCAT(first_name, ' ', last_name) AS name,
							fav_team,
							total_score,
							'$query_last_week'
							FROM 
							player_roster
							ORDER BY
							total_score DESC");
			
		
$query->execute();
					
//create array - data to be displayed in weekly picks table below.

$data=$query->fetchall(PDO::FETCH_ASSOC);
  
//Make sure	query array is not empty, then create html table with all entries
  
if (count($data) > 0) {
	
		
		echo '<table align="center" border="1" cellspacing="5" cellpadding="8">
		
		<tr><th align="center">Player</th>
		<th align="center">Favorite Team</th>
		<th align="center">Total Score</th>
		<th align="center">Previous Week</th>
		</tr>';
		
	// foreach loop to list out each row in the array	
		
		foreach ($data as $row) {
			
				
			echo 
			'<tr><td align="center">' . $row['name'] . '</td>
			<td align="center">' . $row['fav_team'] . '</td>
			<td align="center">' . $row['total_score'] . '</td>
			<td align="center">' . $row['$query_last_week'] . '</td></tr>';
						
		} 
		
		echo  '</table>';
		
	} else {
			echo "query problem";
	
			


		}
?>
</body>
</html>
