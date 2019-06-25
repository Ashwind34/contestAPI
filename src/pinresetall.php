
<?php

require_once('pdo_connect.php');
require_once('pinupdate.php');
require_once('sendMessage.php');

//check if $_POST is empty

if (!empty($_POST["select"])) {

    $emailstoreset = $_POST["select"];

    //loop through each email address and generate new PIN in DB, then mail PIN to email address
 
    foreach ($emailstoreset as $key=>$email) {
        list($recipientEmail, $recipiantName, $subject, $body) = PinUpdate($email);
        send_email_message($recipientEmail, $recipiantName, $subject, $body);
    }
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>
			SuperContest 2019
		</title>
	    <link rel="stylesheet" type="text/css" href="../css/style.css">
		<meta name="viewport" content="width=device-width">
	</head>
    <body>

        <!-- Select multiple emails for manual user PIN updates -->

        <form action="pinresetall.php" method="POST">
            <select multiple size="20" name="select[]">
           
            <?php 

			//query db to get list of player emails and populate select field
			$email_query = $conn->prepare("SELECT email FROM player_roster ORDER BY email ASC");
            
            $email_query->execute();
            
            $email_list = $email_query->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($email_list as $k=>$v) {                
                echo '<option value='. $v['email'] . '>' . $v['email'] . '</option>';                 
            }
                      
            ?>  

            </select>
            <br>
            <textarea name="msgbody" rows="5" cols="20">Greetings, note your registration pin and clink to register</textarea><br>
            <input type="submit" value="Submit">
            <br>
            <p><a href="../index.php">Return to Home Page</a></p>
        </form>
    </body>
</html>