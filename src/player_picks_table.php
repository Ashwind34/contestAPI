<?php 

session_start();

require_once('datecheck.php');
require_once('pdo_connect.php');
require_once('picks_query.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <p>Your picks for week <?php echo $weekmarker; ?> have been submitted!</p>
        <p><a href="../index.php">Return to Home Page</a></p>

        <?php 

        echo $player_picks_table;

        ?>
    </body>
</html>
