<!DOCTYPE html>
<html>
<!-- set page to eliminate data cache storage on reload -->
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<body>
	
	<?php
	
	require_once ('pdo_connect.php');
	require_once ('datecheck.php');
	
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
			$update = "UPDATE player_picks
						SET pick_1_wlt = '$pscore'
						WHERE pick_1 = '$team'";
						
						TRY {
					
							$conn->exec($update);
															
						}
						CATCH (PDOException $e) {
					
							echo $update . '<br>' . $e->getMessage();
						
						}
		}

		?>
		
		</body>
		</html>