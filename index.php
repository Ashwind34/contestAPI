<?php

session_start();

require_once('src/pdo_connect.php');
require_once('src/datecheck.php');

//check if user is logged in

if(isset($_SESSION['player_id'])) {

	header("Location: ./src/home.php");

}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>
			SuperContest 2019
		</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<meta name="viewport" content="width=device-width">
	</head>
	<body class="starBack">
		<div class='menuContainer'>
			<div class='redHead'>
				TECMO<span style='font-size:0.75rem'>&reg</span>
			</div>
			<div class='testcaps'>
				<div>SUPER</div>
				<div>CONTEST</div> 
				<!-- <div>CONTEST<span style='font-size:0.75rem'>TM</span></div>  -->
				<!-- <div>2019</div> -->
			</div>
			<div class='menu'>
				<!-- <div>
					<img class='stars' src="./css/img/starsleft.png" alt=""> -->
					<a href="src/login.php">Login</a>
					<!-- <img class='stars' src="./css/img/starsright.png" alt=""><br>
				</div>
				<div>
					<img src="./css/img/starsleft.png" alt=""> -->
					<?php 
					if($weekmarker < 3){
						echo "<a href='src/register.php'>Register</a>";
					}
					?>

					<!-- <img src="./css/img/starsright.png" alt=""><br>
				</div>
				<div>
					<img src="./css/img/starsleft.png" alt=""> -->
					<a href="src/passreset.php">Change Password</a>
					<!-- <img src="./css/img/starsright.png" alt="">
				</div> -->
			</div>
			<div class='legal'>
				<div>
					TM and &copy TECMO LTD 2019
				</div>
				<div>
					LICENSED BY
				</div>
				<div>
					NINTENDO OF AMERICA INC.
				</div>
			</div>	
		</div>
	</body>
</html>


