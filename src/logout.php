<?php

require_once('sessioncheck.php');

setSession(basename(__FILE__));

session_unset();

session_destroy();

header("Location: ../index.php");

?>