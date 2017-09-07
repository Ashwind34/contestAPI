<?php 


$today = date("Ymd");

//check to make sure $date is not negative

if ($today < "20170907") {
	$date = strtotime("20170907");
} else {
	$date = strtotime(date("Ymd"));
}

// MANUAL DATE OVERRIDE IF NEEDED
//$date = strtotime("09/10/2017 9:15:00");

$season_start = strtotime("09/05/2017");

//$weekmarker variable will return current NFL week value

$weekmarker = ceil((($date - $season_start)/"604800"));

//set variable to identify previous week, if needed

$last_weekmarker = '';

if ($weekmarker = 1) {
	$last_weekmarker = 1;
} else {
$last_weekmarker = $weekmarker - 1;
}




?>