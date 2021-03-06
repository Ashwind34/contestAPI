<?php 

require_once("pdo_connect.php");

date_default_timezone_set("America/New_York");

$today = time();

$today_date = date("m/d/Y h:i:sa", $today);

// SET SEASON START DATE HERE

$season_start = strtotime("09/04/2019");

//check to make sure $date is not negative

($today < $season_start) ? $date = $season_start : $date = $today;

//$weekmarker variable will return current NFL week value

$datetest = (($date - $season_start)/"604800");

$query = "SELECT week 
			FROM weekmarker
			ORDER BY week DESC
			LIMIT 1";

$stmt = $conn->prepare($query);
$stmt->execute();
$weekmarker = $stmt->fetch(PDO::FETCH_COLUMN);

// USE BELOW TO SET WEEKMARKER AUTOMATICALLY BASED ON DATE
// ($datetest > 0) ? $weekmarker = ceil($datetest) : $weekmarker = 1;

$kickoff_marker = $weekmarker - $datetest;

//set variable to identify previous week

$weekmarker != 1 ? $last_weekmarker = $weekmarker - 1 :	$last_weekmarker = 1;

//set variables to identify season quarter

switch ($weekmarker) {
	case in_array($weekmarker, range(1,4)):
		$qtrmarker = 1;
		$qtrend = 4;
		$qtrcol = "q1_score";
		break;
	case in_array($weekmarker, range(5,8)):
		$qtrmarker = 2;
		$qtrend = 8;
		$qtrcol = "q2_score";
		break;
	case in_array($weekmarker, range(9,12)):
		$qtrmarker = 3;
		$qtrend = 12;
		$qtrcol = "q3_score";
		break;
	case in_array($weekmarker, range(13,17)):
		$qtrmarker = 4;
		$qtrend = 17;
		$qtrcol = "q4_score";
		break;
}

?>