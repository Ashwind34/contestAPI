<?php

//THIS FUNCTION RESETS THE PIN AND SETS ALL VARIABLES NEEDED FOR SENDMESSAGE FUNCTION
//NEED TO UPDATE ON DREAMHOST SERVER TO ADD send_email_message FUNCTION AT THE END

function PinUpdate($email) {

    require('pdo_connect.php');
    require('sendMessage.php');

    $pin = 1234; //rand(1000,9999);
    $pin_update =   "UPDATE player_roster 
                    SET pin = '$pin'
                    WHERE email = '$email'";
    $pin_change = $conn->prepare($pin_update);
    $pin_change->execute();

    $email_query = $conn->prepare("SELECT email, first_name, last_name FROM player_roster WHERE email = '$email'");
    $email_query->execute();
    $email_query_array = $email_query->fetch(PDO::FETCH_ASSOC);

    $recipientEmail = $email;
    $recipientName = $email_query_array['first_name'] . " " . $email_query_array ['last_name'];
    $subject = 'NFL SUPERCONTEST - PIN RESET';
    $body = '<html>

            <body>
                <h1>YOUR NEW PIN IS</h1>
                <h3>' . $pin .'</h3>
            </body>
        </html>';


                

    echo $recipientEmail . '<br>';
    echo $recipientName . '<br>';
    echo $subject . '<br>';
    echo $body . '<br>';

    send_email_message($recipientEmail, $recipientName, $subject, $body);

}


?>