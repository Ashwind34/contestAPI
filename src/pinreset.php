<?php 

session_start();

require_once('pdo_connect.php');
require_once('emailcheck.php');
require_once('pinupdate.php');
require_once('sendMessage.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

<?php

if (sessionCheck()) {
    
    $record = $conn->prepare("SELECT player_id, email FROM player_roster WHERE player_id = :id");
    $record->bindParam(':id', $_SESSION['player_id']);
    $record->execute();
    $user = $record->fetch(PDO::FETCH_ASSOC);    

} 

if (!empty($_POST['submit'])) {
    $email = $_POST['email'];

    if (emailCheck($email)) {
        list($recipientEmail, $recipiantName, $subject, $body) = PinUpdate($email);
        send_email_message($recipientEmail, $recipiantName, $subject, $body);
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
                <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>"><br>  
                <input type="submit" name="submit" value="Reset Your Pin">
            </form>
            <div class='formLink'>
                <a href="../index.php">Return to Home Page</a>
            </div>
        </div>
    </body>
</html>

