<?php 

require_once('sessioncheck.php');

session_start();

echo $_SESSION['name'];

phpinfo()

?>	