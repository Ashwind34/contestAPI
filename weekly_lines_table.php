<!DOCTYPE html>
<html>
<body>
<?php 

require_once ('weekly_schedule.php');
require_once ('datecheck.php');

?>

<p style=text-align:center;><a href="../index.php">Return to Home Page</a></p>
<p style=text-align:center; color:blue>Week <?php echo $weekmarker ;?> Lines</p>


<?php

echo $weekly_lines_table

?>

</body>
</html>