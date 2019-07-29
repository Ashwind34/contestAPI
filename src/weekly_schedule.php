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
	'<table class="center">	
		<tr>
			<th>Favorite</th>
			<th>Line</th>
			<th>Underdog</th>
			<th>Kickoff</th>
		</tr>';
    
	// foreach loop to list out each row in the array
	// test to see if home or away is favored, then build table accordingly
    
    foreach ($data as $row) {

		$home = '*'.$row['home'].'*';
		$away = $row['away'];

		if( $row['h_spread'] < $row['a_spread']) {
			$favorite = $home;
			$underdog = $away;
			$spread = $row['h_spread'];
		} else {
			$favorite = $away;
			$underdog = $home;
			$spread = $row['a_spread'];
		}

        echo
		'<tr>
			<td>' . $favorite . '</td>
			<td>' . $spread . '</td>
			<td>' . $underdog . '</td>
			<td>' . date('g:i a', strtotime($row['start_time'])) . '</td>
		</tr>';

    }
            
	echo  '</table>';
	echo '<div class="legal">** = Home Team';
	echo '<br>All Times Eastern</div>';
    
	$weekly_lines_table = ob_get_clean();
	
} else {

    echo "query problem";

}
	
?>

