
<?php

function sessionCheck($url) {

  if(isset($_SESSION['player_id']) && !empty($_SESSION['player_id'])) {
    global $player_id, $player_email, $player_name;
    $player_id = $_SESSION['player_id'];
    $player_email = $_SESSION['email'];
    $player_name = $_SESSION['name'];
  } else {
  	echo '<script type="text/javascript">window.location.href="' . $url . '"</script>';
  }
}

function adminCheck() {
  return (isset($_SESSION['player_id']) && !empty($_SESSION['player_id']) && ($_SESSION['player_id'] == 1 || $_SESSION['player_id'] == 2));
}

?>