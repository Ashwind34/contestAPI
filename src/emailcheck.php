<?php 

function emailcheck($email, $url)
{
    global $conn;

    $emailquery = "SELECT email FROM player_roster";
    $emailresult = $conn->prepare($emailquery);
    $emailresult->execute();
    $emails = $emailresult->fetchall(PDO::FETCH_COLUMN);

    $value = in_array($email, $emails) ? true : false;

    return $value; 
}

$email_error_message =  '<br><p>That email is not in the contest records.  Please try again.</p>
                        <br><p><a href="pinreset.php">Try Again</a></p><br>
                        <br><p><a href="../index.php">Return to Home Page</a></p>';
                        
?>