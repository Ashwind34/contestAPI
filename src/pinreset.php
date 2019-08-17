<?php 

require_once('sessioncheck.php');

setSession(basename(__FILE__));

require_once('pdo_connect.php');
require_once('emailcheck.php');
require_once('pinupdate.php');
require_once('sendMessage.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" /> -->
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

<?php

$player_email = $_SESSION['email'];

if (!empty($_POST['submit'])) {
    $email = $_POST['email'];

    if (emailCheck($email)) {
        list($recipientEmail, $recipiantName, $subject, $body) = PinUpdate($email);
        send_email_message($recipientEmail, $recipiantName, $subject, $body);
        exit();
    } else {
        email_error(basename(__FILE__));
    }
}

?>

	<body>
        <div class="pinContainer">
            <div class="formTitle">
                Reset Your PIN
            </div>
            <form action="pinreset.php" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $player_email;?>"><br>  
                <input type="submit" name="submit" value="Reset Your Pin">
            </form>
            <div class='formLink'>
                <a href="../index.php">Return to Home Page</a>
            </div>
        </div>
    </body>
</html>

