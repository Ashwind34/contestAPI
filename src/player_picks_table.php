<?php 
session_start();

require_once('datecheck.php');
require_once('pdo_connect.php');
require_once('picks_query.php');

if(!sessionCheck()) {

	header("Location: ./login.php");

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preload" href="../css/img/TDbo.png" as="image">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body class="blackBack">
        <div class="wrapper">
            <div class="playerpicksContainer">
                <div class="pickSubmit">
                    <div>
                        Your picks for
                    </div>
                    <div>
                        week <?php echo $weekmarker; ?> are in!
                    </div>
                </div>
                <div>
                    <?php echo $player_picks_table;?>
                </div>
                <div class="formLink">
                    <a class="noMargin" href="../index.php">Return to Home Page</a>
                </div>
                <div class="formLink">
                    <img class="boPic" src="../css/img/TDbo.png" alt="Bo knows Tecmo Bowl">
                </div>           
            </div>
        </div>
        <audio src="../css/audio/touchdown.mp3" id="page_audio"></audio>
        <script src="../audio.js"></script>
    </body>
</html>
