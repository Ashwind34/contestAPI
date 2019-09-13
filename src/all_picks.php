<?php

require_once('picks_query.php');
require_once('datecheck.php');
require_once('sessioncheck.php');

adminCheck();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			All Player Picks
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body class="blackBack">
		<div class ="wrapper">
			<div class="boardContainer">
				<div class='formTitle'>
					PLAYER PICKS<br>
					WEEK <?php echo $weekmarker; ?>
				</div>
				<div class="formLink">
					<a href="home.php">Return to Home Page</a>				
				</div>
				<div>			
					<?php echo $weekly_picks_table;?>				
				</div>
			</div>
		</div>
	</body>
</html>