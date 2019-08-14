<?php

require_once('creds.php');

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password); 
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
}
catch(PDOException $e)
{ 
	echo "Connection failed: " . $e->getMessage();
}

function sessionCheck() {
  return (isset($_SESSION['player_id']) && !empty($_SESSION['player_id']));
}

function adminCheck() {
  return (isset($_SESSION['player_id']) && !empty($_SESSION['player_id']) && ($_SESSION['player_id'] == 1 || $_SESSION['player_id'] == 2));
}

?>
