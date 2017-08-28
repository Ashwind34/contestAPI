<?php 


$player_id = $_SESSION['player_id'];;

//query to pull most recent picks of logged in player

$user_picks_table = $conn->prepare("SELECT					 
								player_roster.user_name, 
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

//ASSIGN EACH PICK AS A VARIABLE

$pick_1 = $user_pick_array['0']['pick_1'];
$pick_2 = $user_pick_array['0']['pick_2'];
$pick_3 = $user_pick_array['0']['pick_3'];
$pick_4 = $user_pick_array['0']['pick_4'];
$pick_5 = $user_pick_array['0']['pick_5'];

function PickDropdown($pick, $conn, $picknum, $weekmarker, $date) {
	
	// query db to get list of teams available to pick for that week
	//REMEMBER TO RESET $DATE TO TIME() LINES 58,62,92 --> ALSO TURN OFF $DATE VARIABLE IN DATECHECK.PHP

	$team_query = 
		"SELECT home AS teamlist
		FROM regseason 
		WHERE week='$weekmarker' AND UNIX_TIMESTAMP(CONCAT(Start_Date, ' ', Start_Time)) > '$date/*time()*/'
		UNION
		SELECT away AS teamlist
		FROM regseason 
		WHERE week='$weekmarker' AND UNIX_TIMESTAMP(CONCAT(Start_Date, ' ', Start_Time)) > '$date/*time()*/'
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
			if($kickoff < $date/*time()*/) {
				
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
		} 
}
	
		
		 	

?> 
	  
