<?php 

require_once('weekly_schedule.php');
require_once('datecheck.php');

session_start();

if(empty($_SESSION['player_id'])) {

	header("Location: ./login.php");

}

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
            <div class='picksSubmit'>
                <?php echo $weekly_lines_table ?>
            </div>
            <div class='formLink'>
                <a class="noMargin" href="../index.php">Return to Home Page</a>
            </div>
        </div>
        <br>
        <br>
    </body>
</html>