<?php

require_once('src/sessioncheck.php');

setSession(basename(__FILE__));

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
				</div>
				<div class='menu'>
					<a href="src/login.php">Login</a>
					<?php 
					if($weekmarker < 3){
						echo "<a href='src/register.php'>Register</a>";
					}
					?>
					<a href="src/passreset.php">Change Password</a>
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


