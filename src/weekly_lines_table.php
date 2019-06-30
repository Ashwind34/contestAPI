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
        <div class ="schedContainer">            
            <div class="formTitle">
                Week <?php echo $weekmarker ;?> Lines
            </div>      
            <div>
                <?php echo $weekly_lines_table ?>
            </div>
            <div class='formLink'>
                <a href="../index.php">Return to Home Page</a>
            </div>
        </div>
    </body>
</html>