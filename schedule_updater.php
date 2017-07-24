<!DOCTYPE html>
<html>
<body>
<!-- <p style=text-align:center; color:blue;></p>
<p style=text-align:center;><a href="index.php">Return to Home Page</a></p> -->


<?php 

require_once ('pdo_connect.php');

//need to fill this in with a function from another file
$datemarker = 1;

/*PDO statement to update spreads and scores from form below
if (empty($_POST(['h_spread']))) {
	} else {
	
	$update=$conn->prepare("INSERT INTO regseason (a_spread, a_score, h_spread,	h_score) 
							VALUES (:a_spread, :a_score, :h_spread, :h_score) 
							WHERE (Home='$row['home']' OR Away='$row['away']')
							AND week='$datemarker'");
							
	$update->BindParam(':a_spread', $_POST['a_spread']);
	$update->BindParam(':a_score', $_POST['a_score']);
	$update->BindParam(':h_spread', $_POST['h_spread']);
	$update->BindParam(':h_score', $_POST['h_score']);
	
	if ($update->execute()) {
			header ("Location: /weekly_schedule.php");
	} else {
		echo "Error in updatng":
	}
}*/

$query=$conn->prepare("SELECT

						home,
						away
						FROM
						regseason
						WHERE
						week='$datemarker'");
						
						 
												
						
$query->execute();

$data=$query->fetchall(PDO::FETCH_ASSOC);
//create array - data to be displayed in table below.  


/* use to check array values
print_r (array_values($data));*/


if (count($data) > 0) {
	
//Make sure	query array is not empty, then create html form with embedded html table


		echo '<form action="schedule_updater_data_test.php" method="post">'; 
		
		// use form tag outside of table and set inputs in each row for spread and team score
		//(make sure to reset action to schedule_updater.php
		
		echo '<table align="center" border="1" cellspacing="5" cellpadding="8">
		
		<tr><th align="center">Home</th>
		<th align="center">Home Spread</th>
		<th align="center">Home Score</th>
		<th align="center">Away</th>
		<th align="center">Away Spread</th>
		<th align="center">Away Score</th>
		</tr>';
		
	// foreach loop to list out each row in the array	
		
		foreach ($data as $row) {
			
				
			echo 
			'<tr><td align="center">' . $row['home'] . '</td>
			<td align="center"><input type="number" name="h_spread" id="h_spread"></td>
			<td align="center"><input type="number" name="h_score" id="h_score"></td>			
			<td align="center">' . $row['away'] . '</td>
			<td align="center"><input type="number" name="a_spread" id="a_spread"></td>
			<td align="center"><input type="number" name="a_score" id="a_score"></td>
			</tr>';
			
			
		} 
		
		
		echo  
		
		'<input type="submit" name="update" value="Update" >
		</table>
		</form>';
		
	} else {
			echo "query problem"; 
	
			


		}


?>
</body>
</html>
