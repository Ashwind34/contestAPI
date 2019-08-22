<?php
require_once('sessioncheck.php');
require_once('datecheck.php');
require_once('pdo_connect.php');

setSession(basename(__FILE__));

if(empty($_SESSION['player_id'])) {

	header("Location: ./login.php");

}

//query for leaderboard table

// $query = "SELECT
// 			player_picks.player_id,
// 			player_picks.week_score,
// 			player_picks.week,
// 			CONCAT(
// 				player_roster.first_name,
// 				' ',
// 				player_roster.last_name
// 			) AS name,
// 			player_roster.total_score,
// 			player_roster." . $qtrcol . " AS qtr
// 			FROM
// 			player_picks
// 			INNER JOIN
// 			player_roster
// 			ON
// 			player_picks.player_id = player_roster.player_id
// 			WHERE
// 			week = '$last_weekmarker'
// 			ORDER BY
// 			total_score DESC, name";

$query = "SELECT
			player_picks.week_score,
			CONCAT(
				player_roster.first_name,
				' ',
				player_roster.last_name
			) AS name,
			player_roster.total_score,
			player_roster." . $qtrcol . " AS qtr
			FROM
			player_picks
			INNER JOIN
			player_roster
			ON
			player_picks.player_id = player_roster.player_id
			WHERE
			week = '$last_weekmarker'
			ORDER BY
			total_score DESC, name";

$stmt = $conn->prepare($query);
			
		
$stmt->execute();
					
//create array - data to be displayed in weekly picks table below.

$data=$stmt->fetchall(PDO::FETCH_ASSOC);

//Make sure	query array is not empty, then create html table with all entries
//Save html output to variable with ob_start(), then echo in html below

if (count($data) > 0) {

	ob_start();

	echo 
	'<table>		
		<tr>
			<th>Player</th>			
			<th>Total Score</th>
			<th>Qtrly Score</th>
			<th>Last Week</th>
		</tr>';
		

		
	// foreach loop to list out each row in the array
		
	foreach ($data as $row) {
		echo
		'<tr>
			<td>' . $row['name'] . '</td>			
			<td>' . $row['total_score'] . '</td>
			<td>' . $row['qtr'] . '</td>
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