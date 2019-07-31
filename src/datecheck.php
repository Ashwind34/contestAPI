<?php 

$today = date("Ymd");

//check to make sure $date is not negative

if ($today < "20190905") {
	$date = strtotime("20190905");
} else {
	$date = strtotime(date("Y/m/d h:i:sa"));
}

// MANUAL DATE OVERRIDE IF NEEDED
$date = strtotime("09/08/2019 10:30:00");

$season_start = strtotime("09/03/2019");

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

//set variable to identify season quarter

$qtrmarker;

switch ($weekmarker) {
	case in_array($weekmarker, range(1,4)):
		$qtrmarker = 1;
		break;
	case in_array($weekmarker, range(5,8)):
		$qtrmarker = 2;
		break;
	case in_array($weekmarker, range(9,12)):
		$qtrmarker = 3;
		break;
	case in_array($weekmarker, range(13,17)):
		$qtrmarker = 4;
		break;
}

?>