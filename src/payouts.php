<?php

require_once('sessioncheck.php');

setSession(basename(__FILE__));

sessionCheck("login.php");

$total = 100;
$first = floor($total * 0.51);
$second = floor($total * 0.22);
$third = floor($total * 0.12);
$fourth = floor($total * 0.07);
$fifth = floor($total * 0.04);
$sixth = floor($total * 0.02);
$seventh = floor($total * 0.01);
$quarterly = 100;


?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>
			SuperContest 2019
		</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<meta name="viewport" content="width=device-width">
	</head>
	<body>
		<div class="wrapper">
			<div class='homeContainer'>
				<div class='redHead'>
					TECMO 
				</div>
				<div class='whiteHead'>
					SUPERCONTEST 2019
				</div>
				<fieldset>
					<legend>Payouts</legend>		
						<div class="payout">1st Place: $<?php echo $first ?></div>
						<div class="payout">2nd Place: $<?php echo $second ?></div>
						<div class="payout">3rd Place: $<?php echo $third ?></div>
						<div class="payout">4th Place: $<?php echo $fourth ?></div>
						<div class="payout">5th Place: $<?php echo $fifth ?></div>
						<div class="payout">6th Place: $<?php echo $sixth ?></div>
						<div class="payout">7th Place: $<?php echo $seventh ?></div>
						<div class="payout">Quarterly Winner: $<?php echo $quarterly ?></div>
				</fieldset>
                <div>
                    <a class="formLink" href="home.php">Return to Home Page</a>
                    <br>
                    <br>
			    </div>
			</div>
		</div>
	</body>
</html>


