<?php

//THIS FUNCTION RESETS THE PIN AND SETS ALL VARIABLES NEEDED FOR SENDMESSAGE FUNCTION

function PinUpdate($email) {

    require('pdo_connect.php');
   
    //generate random 4-digit pin number
    $pin = rand(1000,9999);
    //query to update PIN in db
    $pin_update =   "UPDATE player_roster 
                    SET pin = '$pin'
                    WHERE email = :email";
    $pin_change = $conn->prepare($pin_update);
    $pin_change->BindParam(':email', $email);
    if(null !== ($pin_change->execute())) {
        echo "<p>There was a problem with your PIN reset.  Please check your email and try again.</p>";
        echo '<p><a href="pinresetfresh.php">Try Again</a></p><br>';
        echo '<p><a href="home.php">Return to Home Page</a></p>';
        exit();
    }

    //sql query to get info about user to populate email message
    $email_query = $conn->prepare("SELECT email, first_name, last_name FROM player_roster WHERE email = :email");
    $email_query->BindParam(':email', $email);
    if($email_query->execute()){
        $email_query_array = $email_query->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "<p>There was a problem with your PIN reset.  Please check your email and try again.</p>";
        echo '<p><a href="pinresetfresh.php">Try Again</a></p><br>';
        echo '<p><a href="home.php">Return to Home Page</a></p>';
        exit();
    }
  

    //assign info from db to variables to use in email message
    $recipientEmail = $email;
    $recipientName = $email_query_array['first_name'] . " " . $email_query_array ['last_name'];
    $subject = 'NFL SUPERCONTEST - PIN RESET';
    // CHECK LINK IN BELOW TEMPLATE TO MAKE SURE IT WORKS ON DREAMHOST
    $body = '<html>
                <body>
                    <h3>YOUR NEW SUPERCONTEST PIN IS</h3>
                    <h3>' . $pin .'</h3><br>                    
                    <p><a href="www.nfl-supercontest.com/src/passreset.php">Click Here to Change your Password</a></p>
                </body>
            </html>';               

    //returns array of info to pass to sendMessage.php function
    return array ($recipientEmail, $recipientName, $subject, $body);

}


?>