<?php 

require_once ('pdo_connect.php');
require_once ('datecheck.php');

//db query to pull each player's most recent picks for that week

$picks_table = $conn->prepare("SELECT					 
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
								
								WHERE week = '$weekmarker'");						
						
$picks_table->execute();

//query to pull each player's weekly score for update into player_roster table
//CHECK CODE, MAY NOT BE NEEDED

$week_score_query = $conn->prepare("SELECT
								  player_id, week_score
								FROM
								   player_picks
								INNER JOIN
									(
									SELECT DISTINCT
										player_id AS id,
										MAX(time_entered) AS maxtime
									FROM
										player_picks
									GROUP BY
										id
									ORDER BY
										maxtime
									DESC
								) AS a
								ON
									player_picks.player_id = a.id AND player_picks.time_entered = a.maxtime
								WHERE
									WEEK = '$weekmarker'");

$week_score_query->execute();




?>