<?php 

session_start();

require_once('sessioncheck.php');

if(!adminCheck()) {
	header("Location: ./login.php");
}

phpinfo()

?>	