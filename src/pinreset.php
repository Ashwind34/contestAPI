<?php

session_start();

require_once('pdo_connect.php');
require_once('pinupdate.php');
require_once('sendMessage.php');

if (isset($_SESSION['player_id'])) {
    
    //PDO prepared statement
    $record = $conn->prepare("SELECT player_id, email FROM player_roster WHERE player_id = :id");
    $record->bindParam(':id', $_SESSION['player_id']);
    $record->execute();
    
    //create associative array from query
    $result = $record->fetch(PDO::FETCH_ASSOC);
    
    
    //set $user as array that contains query data
    if (COUNT($result) > 0) {
        $user = $result;
    } else {
        die("No result returned");
    }
}

if (!empty($_POST['submit'])) {

    //set email address for update
    $email = $_POST['email'];

    //call function to
    list($recipientEmail, $recipiantName, $subject, $body) = PinUpdate($email);
    send_email_message($recipientEmail, $recipiantName, $subject, $body);
}


?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<br>
		<br>
		<p><b>Reset Your PIN</b></p>
		<br>
		<p><a href="../index.php">Return to Home Page</a></p>
		<br>
		<form action="pinreset.php" method="post">
			<div style="text-align:center">
				<p>Email Address</p><br>
				<select name="email">			
					<option value="<?php echo $user['email']; ?>"><?php echo $user['email']; ?></option>			
				</select>
				<br>
				<br>			
				<p><input type="submit" name="submit" value="Reset Your Pin"></p>
			</div>
		</form>
	</body>
</html>

