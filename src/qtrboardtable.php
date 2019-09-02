<?php

require_once('sessioncheck.php');

session_start();

require_once('datecheck.php');
require_once('pdo_connect.php');

if(empty($_SESSION['player_id'])) {

	header("Location: ./login.php");

}

//query for leaderboard table

$query = "SELECT 
			CONCAT
			( player_roster.first_name, ' ', player_roster.last_name ) AS name, 
			player_roster." . $qtrcol . " AS qtr,
			IFNULL( 
			(SELECT week_score FROM player_picks WHERE week = " . $last_weekmarker . " AND player_picks.player_id = player_roster.player_id), 0) AS week_score
			FROM player_roster 
			ORDER BY qtr DESC, name";

$stmt = $conn->prepare($query);			
		
$stmt->execute();

$data=$stmt->fetchall(PDO::FETCH_ASSOC);

//Make sure	query array is not empty, then create html table with all entries
//Save html output to variable with ob_start(), then echo in html below

if (count($data) > 0) {

	ob_start();

	echo 
	'<table>		
		<tr>
			<th>Player</th>			
			<th>Qtrly Score</th>
			<th>Last Week</th>
		</tr>';
		

		
	// foreach loop to list out each row in the array
		
	foreach ($data as $row) {
		echo
		'<tr>
			<td>' . $row['name'] . '</td>			
			<td>' . $row['qtr'] . '</td>
			<td>' . $row['week_score'] . '</td>
		</tr>';
	}

	echo  '</table>';

	//save output table to variable

	$qtrboard = ob_get_clean();

} else {
	echo "query problem";
}

?>