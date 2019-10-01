<?php

require_once('sessioncheck.php');

session_start();

require_once('pdo_connect.php');
require_once('datecheck.php');

if(!adminCheck()) {
	header("Location: ./login.php");
}

// insert score and spread data into regseason table after data submit
// STILL NEED TO FORMAT AND RE-FACTOR MOST OF THIS		
// MUST UPDATE THIS TO SIMPLIFY, CAN DO THIS WITH MANY LESS DATABASE QUERIES

if(!empty($_POST['week'])) {

	$query = "UPDATE weekmarker 
				SET week = :week 
				WHERE id = 1";

	$stmt = $conn->prepare($query);
	$stmt->BindParam(':week', $_POST['week']);
	$stmt->execute();

	$weekmarker = $_POST['week'];
}

if (empty($_POST['update'])) {
	} else {
			
			$h_spread_array = $_POST['h_spread'];
			$h_score_array = $_POST['h_score'];
			$a_spread_array = $_POST['a_spread'];
			$a_score_array = $_POST['a_score'];
			
			foreach ($h_spread_array as $game_id => $h_spread) {
					$update = "UPDATE regseason
								SET h_spread = '$h_spread'
								WHERE id = '$game_id'";							
			
					TRY {
					
					$conn->exec($update);
										
					}
					CATCH (PDOException $e) {
					
					echo $update . '<br>' . $e->getMessage();
					}
			}
					
			foreach ($a_spread_array as $game_id => $a_spread) {	
					$update = "UPDATE regseason
								SET a_spread = '$a_spread'
								WHERE id = '$game_id'";							
			
					TRY {
					
					$conn->exec($update);
										
					}
					CATCH (PDOException $e) {
					
					echo $update . '<br>' . $e->getMessage();
					}	
			}
					
			foreach ($h_score_array as $game_id => $h_score) {		
					$update = "UPDATE regseason
								SET h_score = '$h_score'
								WHERE id = '$game_id'";							
			
					TRY {
					
					$conn->exec($update);
										
					}
					CATCH (PDOException $e) {
					
					echo $update . '<br>' . $e->getMessage();
					}
			}
					
					
			foreach ($a_score_array as $game_id => $a_score) {		
					$update = "UPDATE regseason
								SET a_score = '$a_score'
								WHERE id = '$game_id'";							
			
					TRY {
					
					$conn->exec($update);
															
					}
					CATCH (PDOException $e) {
					
					echo $update . '<br>' . $e->getMessage();
					}
			}
			
			//insert score (1, 0.5, or 0) assigned to each team on update 
			
			$marginUpdate = "UPDATE regseason
						SET a_margin = a_score - h_score,
							h_margin = h_score - a_score
						WHERE week = '$weekmarker'";
							
			$A_PscoreUpdate = "UPDATE regseason
								SET A_Pscore = CASE	
									WHEN A_score = 0 AND H_score = 0 THEN 0
									WHEN A_margin + A_spread > 0 THEN 1
									WHEN A_margin + A_spread = 0 THEN 0.5
									WHEN A_margin + A_spread < 0 THEN 0
									ELSE 0
									END
								WHERE Week = '$weekmarker'";

			$H_PscoreUpdate = "UPDATE regseason
								SET H_Pscore = CASE	
									WHEN A_score = 0 AND H_score = 0 THEN 0
									WHEN H_margin + H_spread > 0 THEN 1
									WHEN H_margin + H_spread = 0 THEN 0.5
									WHEN H_margin + H_spread < 0 THEN 0
									ELSE 0
									END
								WHERE Week = '$weekmarker'";
								
			TRY {
				
				$conn->exec($marginUpdate);
				$conn->exec($A_PscoreUpdate);
				$conn->exec($H_PscoreUpdate);
			}
			CATCH (PDOException $e) {
				
				echo $e->getMessage();
			}

			//assign team score (1, 0.5, 0) to each pick in player_picks table
			
			$Weekly_PScoreQuery = $conn->prepare
					(
					"SELECT 	
					home AS teams, 
					H_Pscore AS Pscore
					FROM 
					regseason
					WHERE 
					week = '$weekmarker'
					UNION
					SELECT
					away AS teams,
					A_Pscore AS Pscore
					FROM 
					regseason
					WHERE 
					week = '$weekmarker'");
			
			$Weekly_PScoreQuery->execute();
			
			$Weekly_PscoreTable = $Weekly_PScoreQuery->fetchall(PDO::FETCH_ASSOC);
			
			foreach ($Weekly_PscoreTable as $key => $value){
							
				$team = $value['teams'];
				$pscore = $value['Pscore'];
				
				$update_1 = "UPDATE player_picks
							SET pick_1_wlt = '$pscore'
							WHERE pick_1 = '$team'
							AND week = '$weekmarker'";
							
				$update_2 = "UPDATE player_picks
							SET pick_2_wlt = '$pscore'
							WHERE pick_2 = '$team'
							AND week = '$weekmarker'";
							
				$update_3 = "UPDATE player_picks
							SET pick_3_wlt = '$pscore'
							WHERE pick_3 = '$team'
							AND week = '$weekmarker'";
							
				$update_4 = "UPDATE player_picks
							SET pick_4_wlt = '$pscore'
							WHERE pick_4 = '$team'
							AND week = '$weekmarker'";
							
				$update_5 = "UPDATE player_picks
							SET pick_5_wlt = '$pscore'
							WHERE pick_5 = '$team'
							AND week = '$weekmarker'";
							
				// update week_score for each row of picks and total_score, quarterly score on player_roster table
				//  MAY BE ABLE TO REMOVE $WEEKMARKER CLAUSE IN $UPDATE_WEEK_SCORE??
							
				$update_week_score = "UPDATE player_picks
								SET week_score = pick_1_wlt + pick_2_wlt + pick_3_wlt + pick_4_wlt + pick_5_wlt
								WHERE week = '$weekmarker'"; 
								
				$update_total_score = "UPDATE player_roster AS r,(SELECT player_id, SUM(week_score) as tscore
										FROM player_picks GROUP BY player_id) as p
										SET r.total_score = p.tscore
										WHERE r.player_id = p.player_id";

				$update_q1_score = "UPDATE player_roster AS r,(SELECT player_id, SUM(week_score) as tscore
									FROM player_picks WHERE week IN (1,2,3,4) GROUP BY player_id) as p
									SET r.q1_score = p.tscore
									WHERE r.player_id = p.player_id";

				$update_q2_score = "UPDATE player_roster AS r,(SELECT player_id, SUM(week_score) as tscore
									FROM player_picks WHERE week IN (5,6,7,8) GROUP BY player_id) as p
									SET r.q2_score = p.tscore
									WHERE r.player_id = p.player_id";

				$update_q3_score = "UPDATE player_roster AS r,(SELECT player_id, SUM(week_score) as tscore
									FROM player_picks WHERE week IN (9,10,11,12) GROUP BY player_id) as p
									SET r.q3_score = p.tscore
									WHERE r.player_id = p.player_id";

				$update_q4_score = "UPDATE player_roster AS r,(SELECT player_id, SUM(week_score) as tscore
									FROM player_picks WHERE week IN (13,14,15,16,17) GROUP BY player_id) as p
									SET r.q4_score = p.tscore
									WHERE r.player_id = p.player_id";
							
				TRY {
			
					$conn->exec($update_1);
					$conn->exec($update_2);
					$conn->exec($update_3);
					$conn->exec($update_4);
					$conn->exec($update_5);
					$conn->exec($update_week_score);
					$conn->exec($update_total_score);
					$conn->exec($update_q1_score);
					$conn->exec($update_q2_score);
					$conn->exec($update_q3_score);
					$conn->exec($update_q4_score);
					
				}
				CATCH (PDOException $e) {
			
					echo $e->getMessage();
							
				}
			}
				
		// echo '<script type="text/javascript">window.location.href="weekly_lines_table.php"</script>';
		// exit();
		
		}			

//select data to use for spread/score update table
		
$query=$conn->prepare("SELECT
						home, h_score, h_spread, away, a_score, a_spread, id, week
						FROM
						regseason
						WHERE
						week='$weekmarker'");
						
$query->execute();

//create array - data to be displayed in table below. 

$data=$query->fetchall(PDO::FETCH_ASSOC);

//Make sure	query array is not empty, then create html form with embedded html table

if (count($data) > 0) {

	ob_start();

	echo '<form action="schedule_updater.php" method="post">'; 
	
	// use form tag outside of table and set inputs in each row for spread and team score
			
	echo '<table align="center" border="1" cellspacing="5" cellpadding="8">
	
	<tr><th hidden>Game ID</th>
	<th hidden>Week</th>
	<th align="center">Home</th>
	<th align="center">Home Spread</th>
	<th align="center">Home Score</th>
	<th align="center">Away</th>
	<th align="center">Away Spread</th>
	<th align="center">Away Score</th>
	</tr>';
	
// foreach loop to list out each row in the array	
	
	foreach ($data as $row) {			
			
		echo 
		'<tr><td hidden>' . $row['id'] . '</td>
		<td hidden>' . $row['week'] . '</td>
		<td align="center">' . $row['home'] . '</td>
		<td align="center"><input type="number" step="any" name="h_spread[' . $row['id'] . ']" value=' . $row['h_spread'] . ' id="h_spread"></td>
		<td align="center"><input type="number" name="h_score[' . $row['id'] . ']" value=' . $row['h_score'] . ' id="h_score"></td>			
		<td align="center">' . $row['away'] . '</td>
		<td align="center"><input type="number" step="any" name="a_spread[' . $row['id'] . ']" value=' . $row['a_spread'] . ' id="a_spread"></td>
		<td align="center"><input type="number" name="a_score[' . $row['id'] . ']" value=' . $row['a_score'] . ' id="a_score"></td>
		</tr>';			
		
	} 
			
	echo  
	'</table>
	<p align="center"><input type="submit" name="update" value="Update Lines/Scores"></p>
	<br>
	<br>
	</form>';

	$schedule_updater = ob_get_clean();
		
} else {

	echo "query problem"; 
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			Update the Schedule
		</title>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<meta name="viewport" content="width=device-width">
		<style>
			p: {
				text-align: center;
				color: blue;
			}
		</style>
	</head>
	<body>
		<div style="text-align:center">
			<p><a href="../index.php">Return to Home Page</a></p>
			<p><a href="https://www.westgateresorts.com/hotels/nevada/las-vegas/westgate-las-vegas-resort-casino/supercontest-weekly-card/" target="_blank">Check Vegas Lines</a></p>
			<form action="schedule_updater.php" method="post">
				<p>Set Week for the Contest</p>
				<p><i>Currently Set as Week #<?php echo $weekmarker?></i></p>
				<input type="number" name='week' style="width:50px" value=<?php echo $weekmarker?>>
				<br>
				<br>
				<input type="submit" value="Set Week">
			</form>
			<br>
			<?php echo $schedule_updater;?>
		</div>
	</body>
</html>
