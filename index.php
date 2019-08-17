<?php

session_start();

require_once('src/pdo_connect.php');
require_once('src/datecheck.php');

if(isset($_SESSION['player_id']) && !empty($_SESSION['player_id'])) {

	echo '<script type="text/javascript">window.location.href="./src/home.php"</script>';
}



?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>
			SuperContest 2019
		</title>
		<link rel="preload" href="./css/fonts/tecmo-bowl-body.woff2" as="font" type="font/woff2" crossorigin>
		<link rel="preload" href="./css/fonts/tecmo-bowl-headline.woff2" as="font" type="font/woff2" crossorigin>
		<link rel="preload" href="./css/fonts/francisco-serial-light-regular.woff2" as="font" type="font/woff2" crossorigin>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<meta name="viewport" content="width=device-width">
	</head>
	<body class="starBack">
		<div class="wrapper">
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
						VANDELAY INDUSTRIES, INC.
					</div>
				</div>	
			</div>
		</div>
	</body>
</html>


