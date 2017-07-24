<?php

session_start();

require_once('pdo_connect.php');

if(!empty($_POST['userpass']) && !empty($_POST['useremail'])) {
	
//PDO prepared statement
	$record = $conn->prepare("SELECT player_id, email, password FROM player_roster WHERE email = :email"); 
	$record->bindParam(':email',$_POST['useremail']);
	$record->execute();
	
//create associative array from query
	$result = $record->fetch(PDO::FETCH_ASSOC);
	
//check password entered by user against db password, set session if match
	if (COUNT($result) > 0 && password_verify($_POST['userpass'], $result['password'])) {
	
	$_SESSION['player_id'] = $result['player_id'];
	header("Location: /index.php");
	
		} else { 

			die("Email or password is incorrect, please try again.");
			}
}
?>


<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<br>
<br>
<br>

<form action="login.php" method="post">
	Email Address <input type="text" name="useremail" id="useremail"><br><br>
	Password <input type="password" name="userpass" id="userpass"><br><br>
	<input type="submit" name="login" value="Login">
</form>

</body>


</html>