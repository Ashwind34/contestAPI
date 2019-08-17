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

function sessionCheck($url) {

  if(isset($_SESSION['player_id']) && !empty($_SESSION['player_id'])) {
	$player_id = $_SESSION['player_id'];
	$player_email = $_SESSION['email'];
	$player_name = $_SESSION['fname'];
  } else {
	echo '<script type="text/javascript">window.location.href="' . $url . '"</script>';
  }

}


function adminCheck() {
  return (isset($_SESSION['player_id']) && !empty($_SESSION['player_id']) && ($_SESSION['player_id'] == 1 || $_SESSION['player_id'] == 2));
}

?>
