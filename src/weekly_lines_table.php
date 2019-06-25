<?php 

require_once ('weekly_schedule.php');
require_once ('datecheck.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>    
    <body>
        <p><a href="../index.php">Return to Home Page</a></p>
        <p>Week <?php echo $weekmarker ;?> Lines</p>
        
        <?php

        echo $weekly_lines_table

        ?>
    </body>
</html>