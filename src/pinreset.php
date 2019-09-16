<?php 

require_once('sessioncheck.php');

session_start();

require_once('pdo_connect.php');
require_once('emailcheck.php');
require_once('pinupdate.php');
require_once('sendMessage.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
        <title>
            Reset Your PIN
        </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

<?php

$player_email = $_SESSION['email'];

if (!empty($_POST['submit'])) {
    $email = $_POST['email'];

    if (emailCheck($email)) {
        list($recipientEmail, $recipiantName, $subject, $body) = PinUpdate($email);
        send_email_message($recipientEmail, $recipiantName, $subject, $body);
        echo    '<div class="pickselect"><div><br>A new PIN has been sent to <span class="pinEmail">' . $recipientEmail . '</span> Check your email!</div>
                <div><br><a href="../index.php">Return to Home Page</a></div></div>
                <audio src="../css/audio/extrapoint.mp3" id="page_audio"></audio>
                <script src="../audio.js"></script>';
        exit();
    } else {
        email_error(basename(__FILE__));
    }
}

?>

	<body>
        <div class="wrapper">
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
        </div>
    </body>
</html>

