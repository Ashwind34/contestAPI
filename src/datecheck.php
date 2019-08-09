<?php 

$today = time();

$today_date = date("Y/m/d h:i:sa", $today);

$season_start = strtotime("09/04/2019");

//check to make sure $date is not negative

if ($today < $season_start) {
	$date = $season_start;
} else {
	$date = $today;
}

// date override for beta test

$date = $today + 2419200;

// MANUAL OVERRIDE FOR $DATE IF NEEDED
// $date = strtotime("09/10/2019 10:30:00");

$fake_date = date("Y/m/d h:i:sa", $date);

//$weekmarker variable will return current NFL week value

$datetest = (($date - $season_start)/"604800");

$weekmarker = ceil($datetest);

$kickoff_marker = $weekmarker - $datetest;

//set variable to identify previous week

if ($weekmarker != 1) {
	
	$last_weekmarker = $weekmarker - 1;

} else {

	$last_weekmarker = 1;

}

// MANUAL OVERRIDE FOR $WEEKMARKER IF NEEDED
// $weekmarker = 17;

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