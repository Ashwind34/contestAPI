<!DOCTYPE html>
<html>
<!-- set page to eliminate data cache storage on reload -->
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<body>
<p style=text-align:center; color:blue;></p>
<p style=text-align:center;><a href="index.php">Return to Home Page</a></p>


<?php 

require_once ('pdo_connect.php');
require_once ('datecheck.php');

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

//insert score and spread data into regseason table after data submit

if (empty($_POST['submit'])) {
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
			
			$marginUpdate = "UPDATE regseason
						SET a_margin = a_score - h_score,
							h_margin = h_score - a_score
						WHERE week = '$weekmarker'";
							
			$A_PscoreUpdate = "UPDATE regseason
								SET A_Pscore = CASE	
									WHEN A_margin + A_spread > 0 THEN 1
									WHEN A_margin + A_spread = 0 THEN 0.5
									WHEN A_margin + A_spread < 0 THEN 0
									ELSE 0
									END
								WHERE Week = '$weekmarker'";

			$H_PscoreUpdate = "UPDATE regseason
								SET H_Pscore = CASE	
									WHEN H_margin + H_spread > 0 THEN 1
									WHEN H_margin + H_spread = 0 THEN 0.5
									WHEN H_margin + H_spread < 0 THEN 0
									ELSE 0
									END
								WHERE Week = '$weekmarker'";	
								
			//START HERE.  MUST CREATE QUERY(S) TO UPDATE THE PSCORE FOR EACH PLAYER PICK ACROSS TABLES
			//WILL NEED TO ADD GAME_ID TO EACH PICK IN PLAYER_PICKS TABLE IN ORDER TO UPDATE FROM REGSEASON TABLE
			
			//TEST QUERY, DOES NOT WORK

			/*$PScoreUpdate = 		UPDATE player_picks AS p, 
									(
									SELECT 	
									home AS teams, 
                           			H_Pscore AS Pscore
									FROM regseason
									WHERE week = 1
									UNION
									SELECT
									away AS teams,
									A_Pscore AS Pscore
									FROM regseason
									WHERE week = 1 
									) AS a 

									SET p.pick_1_wlt = a.Pscore 
									WHERE p.pick_1 = a.teams;	*/		
			
			

			
			
			
			
			
			
			TRY {
				
				$conn->exec($margin);
				$conn->exec($A_PscoreUpdate);
				$conn->exec($H_PscoreUpdate);
			}
			CATCH (PDOException $e) {
				
				echo $margin . '<br>' . $e->getMessage();
			}

		header("Location: /weekly_schedule.php");
		
		}			



//Make sure	query array is not empty, then create html form with embedded html table

if (count($data) > 0) {
	
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
			'<p align="center"><input type="submit" name="submit" value="Update"></p>
			</table>
			</form>';
		
	} else {
			echo "query problem"; 

}
?>
</body>
</html>
