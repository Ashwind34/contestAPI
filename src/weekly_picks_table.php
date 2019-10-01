<?php

require_once('sessioncheck.php');

session_start();

require_once('datecheck.php');
require_once('picks_query.php');

sessionCheck("login.php");

?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			Your Picks
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="preload" href="../css/img/tecmoTD.png" as="image">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body class="blackBack">
		<div class="wrapper">
			<div class="picksContainer">				
				<?php 	
					echo '<div class="formTitle">Your Picks for <br>Week ' . $weekmarker . '</div>';
					echo $player_picks_table;
					echo '<a class="formLink" href="home.php">Return to Home Page</a>';				
				?>
				<div class="slide">
					<img class="boPic" src="../css/img/tecmoTD.png" alt="">
				</div>
			</div>
		</div>
	</body>
</html>
