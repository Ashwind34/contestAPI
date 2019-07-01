<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
<?php

require_once('pdo_connect.php');
require_once('pinupdate.php');
require_once('sendMessage.php');

if (!empty($_POST['submit'])) {

    //set email address for update
    $email = $_POST['email'];

    //call function to
    list($recipientEmail, $recipiantName, $subject, $body) = PinUpdate($email);
    send_email_message($recipientEmail, $recipiantName, $subject, $body);
}
?>
    <body>
    <div class="pinContainer">
            <div class="formTitle">
                Reset Your PIN
            </div>
            <form action="pinresetfresh.php" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email"><br>                
                <input type="submit" name="submit" value="Reset Your Pin">
            </form>
            <div class='formLink'>
                <a href="../index.php">Return to Home Page</a>
            </div>
        </div>
    </body>
</html>

