<?php 

function emailCheck($email)
{
    global $conn;

    $emailquery = "SELECT email FROM player_roster";
    $emailresult = $conn->prepare($emailquery);
    $emailresult->execute();
    $emails = $emailresult->fetchall(PDO::FETCH_COLUMN);

    $value = in_array($email, $emails) ? true : false;

    return $value;
}

function email_error($url)
{
    echo '<br><p>That email is not in the contest records.  Please try again.</p>
    <br><p><a href=' . $url . '>Try Again</a></p><br>
    <br><p><a href="../index.php">Return to Home Page</a></p>
    <audio src="../css/audio/nogood.mp3" id="page_audio"></audio>
    <script src="../audio.js"></script>';
    exit();
}

?>