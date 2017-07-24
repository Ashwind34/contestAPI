<!DOCTYPE html>
<html>
<body>
<!-- <p style=text-align:center; color:blue;>Your picks for week [] have been submitted!</p>
<p style=text-align:center;><a href="index.php">Return to Home Page</a></p> -->

</body>
<?php 

require_once ('pdo_connect.php');

$datemarker = 1;
//need to fill this in with a function from another file

$query=$conn->prepare("SELECT

						home,
						h_spread,
						away,
						a_spread,
						start_time
						FROM
						regseason
						WHERE
						week='$datemarker'");
						
						 
												
						
$query->execute();
//query for all picks on record - MUST LIMIT BY WEEK


$data=$query->fetchall(PDO::FETCH_ASSOC);
//create array - data to be displayed in weekly picks table below.  Will need to limit by pick_1_week


/* use to check array values
print_r (array_values($data));*/


if (count($data) > 0) {
	
//Make sure	query array is not empty, then create html table with all entries
		
		echo '<table align="center" border="1" cellspacing="5" cellpadding="8">
		
		<tr><th align="center">Home</th>
		<th align="center">Home Spread</th>
		<th align="center">Away</th>
		<th align="center">Away Spread</th>
		<th align="center">Start Time (Eastern)</th>
		</tr>';
		
	// foreach loop to list out each row in the array	
		
		foreach ($data as $row) {
			
				
			echo 
			'<tr><td align="center">' . $row['home'] . '</td>
			<td align="center">' . $row['h_spread'] . '</td>
			<td align="center">' . $row['away'] . '</td>
			<td align="center">' . $row['a_spread'] . '</td>
			<td align="center">' . date('h:i a',strtotime($row['start_time'])) . '</td>
			</tr>';
			
			
		} 
		
		
		echo  '</table>';
		
	} else {
			echo "query problem"; 
	
			


		}		
?>
</body>
</html>
