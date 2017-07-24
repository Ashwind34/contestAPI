<!DOCTYPE HTML>
<html>
<body>
<?php

/*add this after testing:
$today = date("Ymd");*/

require_once ('pdo_connect.php');

function date_check($start_date) {
	$gametime = strtotime($start_date);
	$season_start = strtotime("09/03/2017");
	$check = ceil((($gametime - $season_start)/"604800"));
	return $check;
}
	
	

$query=$conn->prepare("SELECT
						
						home,
						away,
						week,
						start_date
						FROM
						regseason");
$query->execute();
$data=$query->fetchall(PDO::FETCH_ASSOC);

if(count($data) > 0) {
	
	echo '<table align="center" border="1" cellspacing="5" cellpadding="8">
			
			<tr>
			<th align="center">Home</th>
			<th align="center">Away</th>
			<th align="center">Week</th>
			<th align="center">Start Date</th>
			<th align="center">Datemarker</th>
			</tr>';
			
			foreach ($data as $row) {
				echo 
				
				'<tr>
				<td align="center">' . $row['home'] . '</td>
				<td align="center">' . $row['away'] . '</td>
				<td align="center">' . $row['week'] . '</td>
				<td align="center">' . $row['start_date'] . '</td>
				<td align="center">' . date_check($row['start_date']) . '</td>
				</tr>';
			}
}
	else {
		echo "Query Problem";
	}
				
			
			




?>




</body>


</html>




