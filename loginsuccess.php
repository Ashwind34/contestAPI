<?php

session_start();

require_once('pdo_connect.php');

if( isset($_SESSION['player_id'])) {
	
	$record = $conn->prepare("SELECT player_id, first_name FROM player_roster WHERE player_id = :id"); 
	$record->bindParam(':id',$_SESSION['player_id']);
	$record->execute();
	$result = $record->fetch(PDO::FETCH_ASSOC);
	$user = '';
	if (COUNT($result) > 0 ) {
	$user = $result;
	} else {
		die("No result returned");
}
}
else {
	die("Session failed");
}

?>
	
	

<!DOCTYPE HTML>
<html>
<body>

<h1 style="text-align:center;">LOGIN SUCCESSFUL</h1>
<br/><br/>
<p style="text-align:center;">Welcome <?php echo "$user[first_name]"; ?>!</p>
<br/>
<p style="text-align:center;"><a href="index.php">Home Page</a></p>
</body>
</html>