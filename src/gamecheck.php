<?php 

    function gameCheck ($arr) {

        foreach ($arr as $team) {

            $checkquery =   "SELECT id 
                            FROM regseason 
                            WHERE week = '$weekmarker'
                            AND (home = '$team' OR away = '$team')";
        

            $gamecheck = $conn->query($checkquery);
            $gamecheck->execute();
            $result = $gamecheck->fetchAll(PDO::FETCH_ASSOC);
    }





?>