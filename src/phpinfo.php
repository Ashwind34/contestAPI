<?php 

require_once('sessioncheck.php');

setSession(basename(__FILE__));

echo $_SESSION['name'];

phpinfo()

?>	