<?php
require_once('datecheck.php');
require_once('pdo_connect.php');

session_start();

if(empty($_SESSION['player_id'])) {

	header("Location: ./login.php");

}

//query for leaderboard table

$query = $conn->prepare(
						"SELECT
							player_picks.player_id,
							player_picks.week_score,
							player_picks.week,
							CONCAT(
								player_roster.first_name,
								' ',
								player_roster.last_name
							) AS name,
							player_roster.fav_team,
							player_roster.total_score
						FROM
							player_picks
						INNER JOIN
							player_roster
						ON
							player_picks.player_id = player_roster.player_id
						WHERE
							week = '$last_weekmarker'
						ORDER BY
						total_score DESC, name"
);
			
		
$query->execute();
					
//create array - data to be displayed in weekly picks table below.
//NEED TO ADD LOGIC TO TRUNCATE LONG NAMES TO LAST INITIAL PLUS .

$data=$query->fetchall(PDO::FETCH_ASSOC);

//Make sure	query array is not empty, then create html table with all entries
//Save html output to variable with ob_start(), then echo in html below

if (count($data) > 0) {

	ob_start();

	echo 
	'<table>		
		<tr>
			<th>Player</th>
			<th>Favorite Team</th>
			<th>Total Score</th>
			<th>Last Week</th>
		</tr>';
		
	// foreach loop to list out each row in the array
		
	foreach ($data as $row) {
		echo
		'<tr>
			<td>' . $row['name'] . '</td>
			<td>' . $row['fav_team'] . '</td>
			<td>' . $row['total_score'] . '</td>
			<td>' . $row['week_score'] . '</td>
		</tr>';
	}
		
	echo  '</table>';

	//save output table to variable

	$leaderboard = ob_get_clean();

} else {
	echo "query problem";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- set page to eliminate data cache storage on reload -->
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<div class="boardContainer">
			<div class='formTitle'>
				LEADERBOARD
			</div>
			<div class="formLink">
				<a href="../index.php">Return to Home Page</a>
			</div>
			<div>			
				<?php echo $leaderboard; ?>
				<br>
				<br>
				<a class="formLink" href="../index.php">Return to Home Page</a>
			</div>
		</div>
	</body>
</html>
