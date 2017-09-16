<?php 


$today = date("Ymd");

//check to make sure $date is not negative

if ($today < "20170907") {
	$date = strtotime("20170907");
} else {
	$date = strtotime(date("Y/m/d h:i:sa"));
}

// MANUAL DATE OVERRIDE IF NEEDED
//$date = strtotime("09/17/2017 15:30:00");

$season_start = strtotime("09/05/2017");

//$weekmarker variable will return current NFL week value

$datetest = (($date - $season_start)/"604800");

$weekmarker = ceil($datetest);

$kickoff_marker = $weekmarker - $datetest;

//set variable to identify previous week

$last_weekmarker = $weekmarker - 1;





?>