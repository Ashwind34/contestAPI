<!DOCTYPE html>
<html>
<body>

<p style=text-align:center;><a href="index.php">Return to Home Page</a></p>

</body>
<?php 

require_once ('pdo_connect.php');
require_once ('datecheck.php');


$query=$conn->prepare("SELECT

						home,
						h_spread,
						away,
						a_spread,
						start_time
						FROM
						regseason
						WHERE
						week='$weekmarker'");											
						
$query->execute();

//create array - data to be displayed in weekly picks table below.  

$data=$query->fetchall(PDO::FETCH_ASSOC);


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
