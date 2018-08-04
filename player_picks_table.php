<?php 

session_start();

?>

<!DOCTYPE html>
<html>
<<<<<<< HEAD
<meta name="viewport" content="width=device-width">
=======
<meta name="viewport" content="width=device-width, initial-scale=1.0">
>>>>>>> 2aa6d7ca75aed135284ce6158a746dceb3517302
<body>
<?php 



require_once('datecheck.php');
require_once('pdo_connect.php');
require_once('picks_query.php');

?>

<p style=text-align:center; color:blue;>Your picks for week <?php echo $weekmarker; ?> have been submitted!</p>
<p style=text-align:center;><a href="../index.php">Return to Home Page</a></p>

</body>
<?php 

echo $player_picks_table;

?>
</body>
</html>
