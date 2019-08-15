
<?php

function sessionCheck() {
  return (isset($_SESSION['player_id']) && !empty($_SESSION['player_id']));
}

function adminCheck() {
  return (isset($_SESSION['player_id']) && !empty($_SESSION['player_id']) && ($_SESSION['player_id'] == 1 || $_SESSION['player_id'] == 2));
}

function setSession($file) {
    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 14);
    ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 14);
    if($file === 'index.php') {
        session_save_path('./sessions');
    } else {
        session_save_path('../sessions');
    }
    session_start();
}

?>