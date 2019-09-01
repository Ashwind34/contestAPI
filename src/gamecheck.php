<?php 

    // function to check and see if any two of the players' picks are in the same game
    // takes $_POST array as argument

function gameCheck($arr)
{
    global $conn, $weekmarker;

    $value = true;

    $gamequery =   "SELECT id, home, away
                    FROM regseason 
                    WHERE week = '$weekmarker'";
    try {
        $gamecheck = $conn->query($gamequery);
        $gamecheck->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
    $result = $gamecheck->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $game) {
        if (in_array($game['home'], $arr) && in_array($game['away'], $arr)) {
            $value = false;
        }
    }

    return $value;
}

function timeCheck($arr) {

    global $conn, $weekmarker, $date, $id;

    $checkvalue = true;

    $timequery =   "SELECT home AS teamlist
                    FROM regseason 
                    WHERE week='$weekmarker' 
                    AND UNIX_TIMESTAMP(CONCAT(Start_Date, ' ', Start_Time)) - 10800 > '$date'
                    UNION
                    SELECT away AS teamlist
                    FROM regseason 
                    WHERE week='$weekmarker' 
                    AND UNIX_TIMESTAMP(CONCAT(Start_Date, ' ', Start_Time)) - 10800 > '$date'
                    ORDER BY teamlist ASC";
    try {
        $gamecheck = $conn->query($timequery);
        $gamecheck->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
    $result = $gamecheck->fetchAll(PDO::FETCH_COLUMN);

    $query = "SELECT pick_1, pick_2, pick_3, pick_4, pick_5
                FROM player_picks
                WHERE week = '$weekmarker'
                AND player_id = '$id'";

    try {
        $stmt = $conn->query($query);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }   

    // $raw_arr = raw data, $picks_arr = formatted raw data, $filtered_arr = array of submitted picks without empty spots

    $raw_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $picks_arr = array_values($raw_arr[0]);
    $filtered_arr = array_filter($arr);
    $final_arr = [];

    // $final_arr = all current picks that are different from picks already submitted

    foreach($filtered_arr as $pick) {
        if (!in_array($pick, $picks_arr)) {
            array_push($final_arr, $pick);
        }
    }

    // make sure ONLY NEW PICKS are screened for time

    foreach ($final_arr as $value) {
        if (!in_array($value, $result) && $value !== 'Submit Your Picks') {
            echo $value . '<br>';
            echo $checkvalue;
            $checkvalue = false;     
        }
    }

    return $checkvalue;

}

?>