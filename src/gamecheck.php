<?php 

    function gameCheck($arr)
    {

        global $conn, $weekmarker;

        $value = true;

        $checkquery =   "SELECT id, home, away
                        FROM regseason 
                        WHERE week = '$weekmarker'";

        try {

            $gamecheck = $conn->query($checkquery);

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

?>