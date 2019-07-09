<?php 

require_once('datecheck.php');
require_once('pdo_connect.php');
require_once('picks_query.php');

session_start();

if(empty($_SESSION['player_id'])) {

	header("Location: ./login.php");

}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body class="blackBack">
        <div class="playerpicksContainer">
            <div class="pickSubmit">
                Your picks for week <?php echo $weekmarker; ?> have been submitted!
            </div>
            <div>
                <?php echo $player_picks_table;?>
            </div>
            <div class="formLink">
                <a href="../index.php">Return to Home Page</a>
            </div>
            <div>
                <img class="boPic" src="../css/img/TDbo.png" alt="Bo knows Tecmo Bowl">
            </div>           
        </div>
    </body>
</html>
