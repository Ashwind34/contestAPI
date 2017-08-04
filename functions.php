<<<<<<< HEAD
<?php 


$today = date("Ymd");

//check to make sure $date is not negative

if ($today < "20170907") {
	$date = strtotime("20170907");
} else {
	$date = strtotime(date("Ymd"));
}

// MANUAL DATE OVERRIDE IF NEEDED
//$date = strtotime("<INSERT DATE HERE>");

$season_start = strtotime("09/03/2017");

//$weekmarker variable will return current NFL week value

$weekmarker = ceil((($date - $season_start)/"604800"));

//PRINT VALUES 
echo 
$today . "<br>" . 
$date . "<br>" .
$season_start . "<br>" .
$weekmarker;


=======
<?php 


$today = date("Ymd");

//check to make sure $date is not negative

if ($today < "20170907") {
	$date = strtotime("20170907");
} else {
	$date = strtotime(date("Ymd"));
}

// MANUAL DATE OVERRIDE IF NEEDED
//$date = strtotime("<INSERT DATE HERE>");

$season_start = strtotime("09/03/2017");

//$weekmarker variable will return current NFL week value

$weekmarker = ceil((($date - $season_start)/"604800"));

//PRINT VALUES 
echo 
$today . "<br>" . 
$date . "<br>" .
$season_start . "<br>" .
$weekmarker;


>>>>>>> origin/master
?>