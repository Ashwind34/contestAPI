<?php 

require_once('sessioncheck.php');

session_start();

require_once('weekly_schedule.php');
require_once('datecheck.php');

sessionCheck("login.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <title>
           NFL Schedule
        </title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>    
    <body>
        <div class="wrapper">
            <div class ="schedContainer">            
                <div class="formTitle">
                    Week <?php echo $weekmarker;?> Lines
                </div>      
                <div class='picksSubmit'>
                    <?php echo $weekly_lines_table;?>
                </div>
                <div class='formLink'>
                    <a class="noMargin" href="home.php">Return to Home Page</a>
                </div>
            </div>
        </div>
        <br>
        <br>
    </body>
</html>