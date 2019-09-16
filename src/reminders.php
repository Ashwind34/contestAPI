<?php 

require_once('sessioncheck.php');

session_start();

require_once('pdo_connect.php');
require_once('sendMessage.php');
require_once('datecheck.php');

if(!adminCheck()) {
	header("Location: ./login.php");
}

?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Reminder Emails
		</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
	    <link rel="stylesheet" type="text/css" href="../css/style.css">
		
	</head>

<?php

$forgotPicksQuery = $conn->prepare("SELECT 
                                player_roster.email
								FROM player_roster 
									LEFT JOIN player_picks
										ON player_roster.player_id = player_picks.player_id
								AND week = '$weekmarker'
                                WHERE player_picks.pick_1 IS NULL
								ORDER BY player_roster.email ASC");
                        
$forgotPicksQuery->execute();

$data=$forgotPicksQuery->fetchall(PDO::FETCH_ASSOC);

//check if $_POST is empty

if (!empty($_POST["select"])) {

    $emailstoreset = $_POST["select"];

    $body = '<html>
                <body>
                    <h3>This is a reminder to make your SuperContest Picks!</h3>
                    <h3>' . $_POST["msgbody"] .'</h3><br>                    
                    <p><a href="www.nfl-supercontest.com">Click Here to go to the site.</a></p>
                </body>
            </html>';
            
    $subject = 'SuperContest Reminder';
 
    foreach ($emailstoreset as $key=>$email) {
        $name_query = $conn->prepare("SELECT email, first_name, last_name FROM player_roster WHERE email = :email");
        $name_query->BindParam(':email', $email);
        $name_query->execute();
        $name_result = $name_query->fetch(PDO::FETCH_ASSOC);
        $recipiantName = $name_result['first_name'] . ' ' . $name_result['last_name'];
        send_email_message($email, $recipiantName, $subject, $body);
        echo 'Reminder sent to ' . $email;
    }
    echo '<p><a href="./admin.php">Return to Admin</a></p>';
    exit();
}

?>
    <body>

        <!-- Select multiple emails for manual user PIN updates -->

        <form action="reminders.php" method="POST">
            <select class="allselect" multiple size="20" name="select[]">
           
            <?php 
            
            foreach($data as $k=>$v) {                
                echo '<option value='. $v['email'] . '>' . $v['email'] . '</option>';                 
            }
                      
            ?>  

            </select>
            <br>
            <textarea name="msgbody" rows="5" cols="20">Don't forget to make your picks for this week!</textarea><br>
            <input type="submit" value="Submit">
            <br>
            <p><a href="./admin.php">Return to Admin Page</a></p>
        </form>
    </body>
</html>