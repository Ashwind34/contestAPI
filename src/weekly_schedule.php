<?php 

require_once('pdo_connect.php');
require_once('datecheck.php');


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
    //use ob_start to catch HTML table output in a variable $weekly_lines_table
        
    ob_start();

	echo 
	'<table>	
		<tr>
			<th>Home</th>
			<th>Home Spread</th>
			<th>Away</th>
			<th>Away Spread</th>
			<th>Start Time (Eastern)</th>
		</tr>';
    
    // foreach loop to list out each row in the array
    
    foreach ($data as $row) {
        echo
		'<tr>
			<td>' . $row['home'] . '</td>
			<td>' . $row['h_spread'] . '</td>
			<td>' . $row['away'] . '</td>
			<td>' . $row['a_spread'] . '</td>
			<td>' . date('h:i a', strtotime($row['start_time'])) . '</td>
		</tr>';
    }
            
    echo  '</table>';
    
	$weekly_lines_table = ob_get_clean();
	
} else {

    echo "query problem";

}
	
?>

