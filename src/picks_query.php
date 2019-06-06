<?php 

require_once ('datecheck.php');
require_once ('pdo_connect.php');


$player_id = $_SESSION['player_id'];;

//query to pull LOGGED-IN player's most recent picks 

$user_picks_table = $conn->prepare("SELECT					 
									player_picks.player_id,
									player_picks.pick_1,
									player_picks.pick_2,
									player_picks.pick_3,
									player_picks.pick_4,
									player_picks.pick_5,
									player_picks.week
									FROM player_picks
									WHERE week = '$weekmarker'
									AND player_picks.player_id = '$player_id'");
			
						
$user_picks_table->execute();

//create array to pull data from

$user_pick_array = $user_picks_table->fetchALL(PDO::FETCH_ASSOC);

//Create HTML table and assign output to $player_picks_table variable

ob_start();

echo 

'<table align="center" border="1" cellspacing="5" cellpadding="8">
<tr><th align="center">Pick #1</th>
<th align="center">Pick #2</th>
<th align="center">Pick #3</th>
<th align="center">Pick #4</th>
<th align="center">Pick #5</th>';

// foreach loop to list out each row in the array	

foreach ($user_pick_array as $row) {	
		
	echo 
	'<tr><td align="center">' . $row['pick_1'] . '</td>
	<td align="center">' . $row['pick_2'] . '</td>
	<td align="center">' . $row['pick_3'] . '</td>
	<td align="center">' . $row['pick_4'] . '</td>
	<td align="center">' . $row['pick_5'] . '</td>';
	echo '</tr>';			
	
} 			

echo  '</table>';

//variable that will display logged-in player's current picks for that week

$player_picks_table = ob_get_clean();			
			
//db query to pull EACH player's most recent picks for that week

$picks_table = $conn->prepare("SELECT 
								CONCAT(
									player_roster.first_name,
									' ',
									player_roster.last_name
									) AS name,
								player_roster.fav_team,						 
								player_picks.player_id,
								player_picks.pick_1,
								player_picks.pick_2,
								player_picks.pick_3,
								player_picks.pick_4,
								player_picks.pick_5,
								player_picks.week,
								player_picks.time_entered
								FROM player_roster 
									INNER JOIN player_picks
										ON player_roster.player_id = player_picks.player_id
								WHERE week = '$weekmarker'
								ORDER BY player_roster.last_name ASC");						
						
$picks_table->execute();

$data=$picks_table->fetchall(PDO::FETCH_ASSOC);
  
//Make sure	query array is not empty, then create html table with all entries
  
if (count($data) > 0) {
	
	ob_start();
	
	echo '<table align="center" border="1" cellspacing="5" cellpadding="8">
	
	<tr><th align="center">Player</th>
	<!-- <th align="center">Favorite Team</th> -->
	<th align="center">Pick #1</th>
	<th align="center">Pick #2</th>
	<th align="center">Pick #3</th>
	<th align="center">Pick #4</th>
	<th align="center">Pick #5</th>';
	
	// foreach loop to list out each row in the array	
	
	foreach ($data as $row) {

		echo 
		'<tr><td align="center">' . $row['name'] . '</td>
		<!-- <td align="center"><i>' . $row['fav_team'] . '</i></td> -->
		<td align="center">' . $row['pick_1'] . '</td>
		<td align="center">' . $row['pick_2'] . '</td>
		<td align="center">' . $row['pick_3'] . '</td>
		<td align="center">' . $row['pick_4'] . '</td>
		<td align="center">' . $row['pick_5'] . '</td>';
		echo '</tr>';			
		
	} 
			
	echo  '</table>';
		
	//variable that will display each player's current picks for that week
		
	$weekly_picks_table = ob_get_clean();
	
} 

//function that populates pick dropdown menus with correct teams based on kickoff times
	
function PickDropdown($pick, $picknum) {
	
	global $date, $player_id, $conn, $weekmarker, $user_pick_array;

	// query db to get list of teams available to pick for that week

	$t = $date; //time();

	$team_query = "SELECT home AS teamlist
					FROM regseason 
					WHERE week='$weekmarker' 
					AND UNIX_TIMESTAMP(CONCAT(Start_Date, ' ', Start_Time)) > '$t'
					UNION
					SELECT away AS teamlist
					FROM regseason 
					WHERE week='$weekmarker' 
					AND UNIX_TIMESTAMP(CONCAT(Start_Date, ' ', Start_Time)) > '$t'
					ORDER BY teamlist ASC";

	$team_list_query = $conn->prepare($team_query);

	$team_list_query->execute();

	//create array with all teams whose games have not started

	$avail_teams_array = $team_list_query->fetchAll(PDO::FETCH_COLUMN);

	//assign current pick to a variable

	$current_pick = $user_pick_array[0][$picknum];

		//check to make sure that a pick already submitted cannot be changed after kickoff
				
		if (!empty($current_pick)) {
			
			if(!in_array($current_pick, $avail_teams_array)) {
				
				echo '<p><select name="' . $picknum . '">';
				echo '<option value="">-Select-</option>';
				echo '<option value="' . $current_pick . '">' . $current_pick .'</option>';
				echo '</select></p><br>';							
								
								
			// else enable dropdown menu wth remaining games
		
			} else {
				
				echo '<p><select name="' . $picknum . '">';
				echo '<option value="">-Select-</option>';
				 
				// insert team list as options for picks dropdown list
				
					$query = $conn->prepare($team_query);
					$query->execute();		
						while ($teamlist = $query->fetch(PDO::FETCH_ASSOC)){
						
							echo '<option value="' . $teamlist['teamlist'] . '">' . $teamlist['teamlist'] . '</option>';
							
						} echo '</select></p><br>';
			}
			
		} else {

			echo '<p><select name="' . $picknum . '">';

			echo '<option value="">-Select-</option>';

			// insert team list as options for picks dropdown list
			
			$query = $conn->prepare($team_query);

			$query->execute();
			
			while ($teamlist = $query->fetch(PDO::FETCH_ASSOC)){
					
				echo '<option value="' . $teamlist['teamlist'] . '">' . $teamlist['teamlist'] . '</option>';
						
			} echo '</select></p><br>';
		
		}
		
}		

?> 
	  
