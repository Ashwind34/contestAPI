<?php

//THIS FUNCTION RESETS THE PIN AND SETS ALL VARIABLES NEEDED FOR SENDMESSAGE FUNCTION

function PinUpdate($email) {

    global $conn;
   
    //generate random 4-digit pin number
    $pin = rand(1000,9999);
    //query to update PIN in db
    $pin_update =   "UPDATE player_roster 
                    SET pin = '$pin'
                    WHERE email = :email";
    $pin_change = $conn->prepare($pin_update);
    $pin_change->BindParam(':email', $email);
    $pin_change->execute();
    
    //query to get info about user to populate email message
    $email_query = $conn->prepare("SELECT email, first_name, last_name FROM player_roster WHERE email = :email");
    $email_query->BindParam(':email', $email);
    $email_query->execute();
    $email_query_array = $email_query->fetch(PDO::FETCH_ASSOC);

    //assign info from db to variables to use in email message
    $recipientEmail = $email;
    $recipientName = $email_query_array['first_name'] . " " . $email_query_array ['last_name'];
    $subject = 'NFL SUPERCONTEST - PIN RESET';
    // CHECK LINK IN BELOW TEMPLATE TO MAKE SURE IT WORKS ON DREAMHOST
    $body = '<html>
                <body>
                    <h3>YOUR NEW SUPERCONTEST PIN IS</h3>
                    <h3>' . $pin .'</h3><br>                    
                    <p><a href="www.nfl-supercontest.com/index.php">Click Here to go to the site.</a></p>
                </body>
            </html>';               

    //returns array of info to pass to sendMessage.php function
    return array ($recipientEmail, $recipientName, $subject, $body);

}


?>