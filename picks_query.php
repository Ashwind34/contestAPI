<?php 

require_once ('datecheck.php');
require_once ('pdo_connect.php');


$player_id = $_SESSION['player_id'];;

//query to pull LOGGED-IN player's most recent picks 

$user_picks_table = $conn->prepare("SELECT					 
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
										INNER JOIN
										(
											SELECT DISTINCT player_id AS id , MAX(time_entered) AS maxtime
											FROM player_picks 
											GROUP BY id
											ORDER BY maxtime DESC
										) AS a
										 ON player_roster.player_id = a.id
										 AND player_picks.time_entered = a.maxtime
									
									WHERE week = '$weekmarker'
									AND a.id = '$player_id'");
			
						
$user_picks_table->execute();

//create array to pull data from

$user_pick_array = $user_picks_table->fetchALL(PDO::FETCH_ASSOC);

//Create HTML table and assign output to $player_picks_table variable

			ob_start();
			
			echo '<table align="center" border="1" cellspacing="5" cellpadding="8">
		
			<tr><th align="center">Pick #1</th>
			<th align="center">Pick #2</th>
			<th align="center">Pick #3</th>
			<th align="center">Pick #4</th>
			<th align="center">Pick #5</th>
			<th align="center">Time of Entry</th></tr>';
			
			// foreach loop to list out each row in the array	
			
			foreach ($user_pick_array as $row) {
				
					
				echo 
				'<tr><td align="center">' . $row['pick_1'] . '</td>
				<td align="center">' . $row['pick_2'] . '</td>
				<td align="center">' . $row['pick_3'] . '</td>
				<td align="center">' . $row['pick_4'] . '</td>
				<td align="center">' . $row['pick_5'] . '</td>
				<td align="center">' . $row['time_entered'] . '</td>';
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
									INNER JOIN
									(
										SELECT DISTINCT player_id AS id , MAX(time_entered) AS maxtime
										FROM player_picks 
										GROUP BY id
										ORDER BY maxtime DESC
									) AS a
									 ON player_roster.player_id = a.id
									 AND player_picks.time_entered = a.maxtime
								
								WHERE week = '$weekmarker'
								ORDER BY name ASC");						
						
$picks_table->execute();

$data=$picks_table->fetchall(PDO::FETCH_ASSOC);
  
//Make sure	query array is not empty, then create html table with all entries

  
if (count($data) > 0) {
	
		ob_start();
		
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
			'<tr><td align="center">' . $row['name'] . '</td>
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
			
		//variable that will display each player's current picks for that week
			
		$weekly_picks_table = ob_get_clean();
	
	} else {
			echo "query problem";
	}
	

			
		
//assign each pick as a variable

$pick_1 = $user_pick_array['0']['pick_1'];
$pick_2 = $user_pick_array['0']['pick_2'];
$pick_3 = $user_pick_array['0']['pick_3'];
$pick_4 = $user_pick_array['0']['pick_4'];
$pick_5 = $user_pick_array['0']['pick_5'];

//function that populates pick dropdown menus with correct teams based on kickoff times
	
function PickDropdown($pick, $conn, $picknum, $weekmarker) {
	
	// query db to get list of teams available to pick for that week
	
	$t = time();

	$team_query = 
		"SELECT home AS teamlist
		FROM regseason 
		WHERE week='$weekmarker' AND UNIX_TIMESTAMP(CONCAT(Start_Date, ' ', Start_Time)) > '$t'
		UNION
		SELECT away AS teamlist
		FROM regseason 
		WHERE week='$weekmarker' AND UNIX_TIMESTAMP(CONCAT(Start_Date, ' ', Start_Time)) > '$t'
		ORDER BY teamlist ASC";

	//query to pull any pick already submitted with kickoff time as UNIX timestamp
	
	$user_picks_check = $conn->prepare("SELECT
										home AS teams,
										UNIX_TIMESTAMP(CONCAT(Start_Date, ' ', Start_Time)) AS kickoff
										FROM regseason
										WHERE week = '$weekmarker'
										AND home = '$pick'
										UNION
										SELECT
										away AS teams,
										UNIX_TIMESTAMP(CONCAT(Start_Date, ' ', Start_Time)) AS kickoff
										FROM regseason
										WHERE week = '$weekmarker'
										AND away = '$pick'");
	$user_picks_check->execute();
										
	//create array to pull data from 
										
	$picks_check_array = $user_picks_check->fetch(PDO::FETCH_ASSOC);

	$kickoff = $picks_check_array['kickoff'];

		
		//check to make sure that a pick already submitted cannot be changed after kickoff
				
		if (!empty($pick)) {
			
			if($kickoff < $t) {
				
				echo '<p><select name="' . $picknum . '">';
				echo '<option value="">-Select-</option>';
				echo '<option value="' . $pick . '">' . $pick .'</option>';
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
			
			//SOMETHING WRONG HERE...TEAMS THAT HAVE ALREADY PLAYED STILL AVAILABLE IF NOT PICKED BEFORE
			//ISSUE WITH $TEAM_QUERY LOGIC
			
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
	  
