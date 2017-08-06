<!DOCTYPE html>
<html>
<body>
<!-- <p style=text-align:center; color:blue;></p>
<p style=text-align:center;><a href="index.php">Return to Home Page</a></p> -->


<?php 

require_once ('pdo_connect.php');
require_once ('datecheck.php');


/*PDO statement to update spreads and scores from form below
if (empty($_POST(['submit']))) {
	} else {
	
	 
		foreach($update_data as $id => $value){
			$update = "INSERT INTO regseason (a_spread, a_score, h_spread, h_score) 
							VALUES (a_spread['id'], a_score['id'], h_spread['id'], h_score['id') 
							WHERE week='$datemarker'"
			
	
	
	/*$update=$conn->prepare();
							
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
						away,
						id,
						week
						FROM
						regseason
						WHERE
						week='$weekmarker'");
						
						 
												
						
$query->execute();

//create array - data to be displayed in table below. 
$data=$query->fetchall(PDO::FETCH_ASSOC);
 


/* use to check array values
print_r (array_values($data));*/

//Make sure	query array is not empty, then create html form with embedded html table

if (count($data) > 0) {
	
		echo '<form action="schedule_updater.php" method="post">'; 
		
		// use form tag outside of table and set inputs in each row for spread and team score
		//(make sure to reset action to schedule_updater.php
		
		echo '<table align="center" border="1" cellspacing="5" cellpadding="8">
		
		<tr><th hidden>Game ID</th>
		<th hidden>Week</th>
		<th align="center">Home</th>
		<th align="center">Home Spread</th>
		<th align="center">Home Score</th>
		<th align="center">Away</th>
		<th align="center">Away Spread</th>
		<th align="center">Away Score</th>
		</tr>';
		
	// foreach loop to list out each row in the array	
		
		foreach ($data as $row) {
			
				
			echo 
			'<tr><td hidden>' . $row['id'] . '</td>
			<td hidden>' . $row['week'] . '</td>
			<td align="center">' . $row['home'] . '</td>
			<td align="center"><input type="number" name="h_spread[]" id="h_spread"></td>
			<td align="center"><input type="number" name="h_score[]" id="h_score"></td>			
			<td align="center">' . $row['away'] . '</td>
			<td align="center"><input type="number" name="a_spread[]" id="a_spread"></td>
			<td align="center"><input type="number" name="a_score[]" id="a_score"></td>
			</tr>';
			
			
		} 
		
		
		echo  
		
		'<input type="submit" name="submit" value="Update" >
		</table>
		</form>';
		
		;
		
		//$update_data = var_dump($_POST);
		
	} else {
			echo "query problem"; 
	
			


		}
		
		
		
		


?>
</body>
</html>
