<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

<?php

session_start();

require_once('pdo_connect.php');
// require_once('pinupdate.php');
// require_once('sendMessage.php');

if (isset($_SESSION['player_id'])) {
    
    $record = $conn->prepare("SELECT player_id, email FROM player_roster WHERE player_id = :id");
    $record->bindParam(':id', $_SESSION['player_id']);
    $record->execute();
    $user = $record->fetch(PDO::FETCH_ASSOC);    

} 

if (!empty($_POST['submit'])) {

    $emailquery = "SELECT email FROM player_roster";    
    $emailresult = $conn->prepare($emailquery);
    $emailresult->execute();
    $emails = $emailresult->fetchall(PDO::FETCH_COLUMN);

    if(in_array($_POST['email'], $emails)) {
        
        $email = $_POST['email'];

        echo "<p>That email IS in the contest records!</p>";
        echo '<p><a href="pinreset.php">Try Again</a></p><br>';
        echo '<p><a href="../index.php">Return to Home Page</a></p>';
        exit();

        //call function to set email address for update

        // list($recipientEmail, $recipiantName, $subject, $body) = PinUpdate($email);
        // send_email_message($recipientEmail, $recipiantName, $subject, $body);

    } else {
        echo "<p>That email is not in the contest records.  Please try again.</p>";
        echo '<p><a href="pinreset.php">Try Again</a></p><br>';
        echo '<p><a href="../index.php">Return to Home Page</a></p>';
        exit();
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

