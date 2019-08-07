<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<title>Week <?php echo $weekmarker;?> Picks</title>
	</head>		

<?php

session_start();

require_once('pdo_connect.php');
require_once('datecheck.php');
require_once('picks_query.php');
require_once('weekly_schedule.php');
require_once('gamecheck.php');
require_once('weekly_schedule.php');
// require_once('leaderboardtable.php');

if (isset($_SESSION['player_id'])) {
    
    //PDO prepared statement

    $record = $conn->prepare("SELECT player_id, first_name FROM player_roster WHERE player_id = :id");
    $record->bindParam(':id', $_SESSION['player_id']);
    $record->execute();
    
    //create associative array from query
    $result = $record->fetch(PDO::FETCH_ASSOC);    
    
    //set $user as array that contains query data
    if (COUNT($result) > 0) {
        $user = $result;
    } else {
        die("No result returned");
    }
} else {    
    header("Location: ./login.php");
}

//skip sql query before data is entered

if (!empty($_POST['submit'])) {

    //make sure that all picks are filled
    
    if (!empty($_POST['pick_1']) && !empty($_POST['pick_2']) && !empty($_POST['pick_3']) && !empty($_POST['pick_4'])
        && !empty($_POST['pick_5'])) {

            //check for duplicate picks

            if ($_POST === array_unique($_POST)) {

                // check to make sure players don't select both teams from one game

                if (gameCheck($_POST)) {   
                           
                    // insert picks into picks log table in case there is a problem
                    
                    // $submit = $conn->prepare("INSERT INTO picks_log (player_id, pick_1, pick_2, pick_3, pick_4, pick_5, week) 
                    //                         VALUES (:player_id, :pick_1, :pick_2, :pick_3, :pick_4, :pick_5, :weekmarker)");
                                            
                    // $submit->BindParam(':pick_1', $_POST['pick_1']);
                    // $submit->BindParam(':pick_2', $_POST['pick_2']);
                    // $submit->BindParam(':pick_3', $_POST['pick_3']);
                    // $submit->BindParam(':pick_4', $_POST['pick_4']);
                    // $submit->BindParam(':pick_5', $_POST['pick_5']);
                    // $submit->BindParam(':player_id', $_SESSION['player_id']);
                    // $submit->BindParam(':weekmarker', $weekmarker);
                    
                    // //make sure statement executes correctly, then send to table with all player picks
                                    
                    // if ($submit->execute()) {
                    //     header("Location: weekly_picks_table.php");
                    // } else {
                    //     echo "It seems like there was a problem submitting your picks.  Please try again.";
                    // }
                        
                    //updates player picks table to show current most recent picks
                    //CREATE A FUNCTION FOR THESE UPDATE STATEMENTS, USE FOREACH LOOP TO PROCESS EACH PICK
                        
                    $id = $_SESSION['player_id'];

                    $upsert = $conn->prepare(
                                        "INSERT INTO player_picks (player_id, pick_1, pick_2, pick_3, pick_4, pick_5, week) 
                                        VALUES 
                                            (:player_id, :pick_1, :pick_2, :pick_3, :pick_4, :pick_5, :weekmarker)
                                        ON DUPLICATE KEY UPDATE
                                            pick_1 = :pick_1, 
                                            pick_2 = :pick_2, 
                                            pick_3 = :pick_3, 
                                            pick_4 = :pick_4, 
                                            pick_5 = :pick_5
                                        -- WHERE 
                                        --     week = '$weekmarker'
                                        -- AND 
                                        --     player_id = '$id'"                                         
                                        );
                    
                    $upsert->BindParam(':pick_1', $_POST['pick_1']);
                    $upsert->BindParam(':pick_2', $_POST['pick_2']);
                    $upsert->BindParam(':pick_3', $_POST['pick_3']);
                    $upsert->BindParam(':pick_4', $_POST['pick_4']);
                    $upsert->BindParam(':pick_5', $_POST['pick_5']);
                    $upsert->BindParam(':player_id', $id);
                    $upsert->BindParam(':weekmarker', $weekmarker);

                    if ($upsert->execute()) {
                        header("Location: weekly_picks_table.php");
                    } else {
                        echo "It seems like there was a problem submitting your picks.  Please try again.";
                        exit();
                    }
                       

                    

                    // try {
                        
                    //     $conn->exec($upsert);

                    // } catch (PDOException $e) {

                    //     echo $e->getMessage();

                    // }
                    

                    // $pick_1_in = $_POST['pick_1'];
                    // $pick_2_in = $_POST['pick_2'];
                    // $pick_3_in = $_POST['pick_3'];
                    // $pick_4_in = $_POST['pick_4'];
                    // $pick_5_in = $_POST['pick_5'];
                    // $player_id_in = $_SESSION['player_id'];

                                
                    // $submit_1 = "UPDATE player_picks 
                    //             SET pick_1 = '$pick_1_in' 
                    //             WHERE week = '$weekmarker'
                    //             AND player_id = '$player_id_in'";
                                
                    // $submit_2 = "UPDATE player_picks 
                    //             SET pick_2 = '$pick_2_in' 
                    //             WHERE week = '$weekmarker'
                    //             AND player_id = '$player_id_in'";
                                
                    // $submit_3 = "UPDATE player_picks 
                    //             SET pick_3 = '$pick_3_in' 
                    //             WHERE week = '$weekmarker'
                    //             AND player_id = '$player_id_in'";
                                
                    // $submit_4 = "UPDATE player_picks 
                    //             SET pick_4 = '$pick_4_in' 
                    //             WHERE week = '$weekmarker'
                    //             AND player_id = '$player_id_in'";

                    // $submit_5 = "UPDATE player_picks 
                    //             SET pick_5 = '$pick_5_in'
                    //             WHERE week = '$weekmarker'
                    //             AND player_id = '$player_id_in'";
                                
                            
                    // try {
                    //     $conn->exec($submit_1);
                    //     $conn->exec($submit_2);
                    //     $conn->exec($submit_3);
                    //     $conn->exec($submit_4);
                    //     $conn->exec($submit_5);
        
                    echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=player_picks_table.php">';
                    header("Location: ./player_picks_table.php");

                } else {
                    echo '<p><b>You cannot select both sides of the same game!</b></p><br>';
                    echo '<p><a href="picksinput.php">Try Again</a></p><br>';
                    echo '<p><a href="home.php">Return to Home Page</a></p>';
                    exit();
                }

            } else {

                echo '<p><b>You cannot select the same team twice!</b></p><br>';
                echo '<p><a href="picksinput.php">Try Again</a></p><br>';
                echo '<p><a href="home.php">Return to Home Page</a></p>';
                exit();
            }
		
    } else {

        echo '<p><b>Please select 5 teams!</b></p><br>';
        echo '<p><a href="picksinput.php">Try Again</a></p><br>';
        echo '<p><a href="home.php">Return to Home Page</a></p>';
		exit();
		
    }
}

	
?>

	<body>
        <div class="wrapper">
            <div class="inputContainer">
                <div class="picksTitle">
                    Make your picks for Week <?php echo "$weekmarker, $user[first_name]";?>!
                </div>
                <div>			
                    <?php echo $weekly_lines_table ?>	
                </div>
                <div class="pickselect" style="font-size:0.85rem;">
                    <span class="bold">***</span>Your Current Picks<span class="bold">***</span>
                </div>
                <div>
                    <!-- $player_picks_table located in picks_query.php -->
                    <?php echo $player_picks_table;?>
                    <br>
                </div>

                <!--dropdown menus for each pick, referenced from function in picks_query.php -->

                <form action="picksinput.php" method="post">
                    <div class="pickselect">
                        Pick #1		
                        <?php PickDropdown($pick_1,'pick_1'); ?>
                    </div>
                    <div class="pickselect">
                        Pick #2
                        <?php PickDropdown($pick_2, 'pick_2'); ?> 
                    </div> 
                    <div class="pickselect">	
                        Pick #3
                        <?php PickDropdown($pick_3, 'pick_3'); ?>
                    </div>
                    <div class="pickselect">
                        Pick #4
                        <?php PickDropdown($pick_4, 'pick_4'); ?>
                    </div>
                    <div class="pickselect">
                        Pick #5
                        <?php PickDropdown($pick_5,'pick_5'); ?>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Submit Your Picks">
                    </div>                			
                </form>	
                <br> 	
                <div class="formLink">
                    <!-- <a href="weekly_lines_table.php">Check the Schedule</a> -->
                    <a href="../index.php">Return to Home Page</a>                
                </div>
            </div>
            <br>
            <br>
        </div>
	</body>
</html>