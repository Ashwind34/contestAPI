<?php

require_once('pdo_connect.php');
require_once('pinupdate.php');
require_once('sendMessage.php');

if (!empty($_POST['submit'])) {

    //set email address for update
    $email = $_POST['useremail'];

    //call function to 
	list ($recipientEmail, $recipiantName, $subject, $body) = PinUpdate($email);
	send_email_message($recipientEmail, $recipiantName, $subject, $body);
}

?>

<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<style>

	p{text-align:center;}
	
</style>

<body>

<br>
<br>
<p style="font-size:25px"><b>Reset Your PIN</b></p>
<br>
<p><a href="../index.php">Return to Home Page</a></p>
<br>

<form action="pinresetfresh.php" method="post">

	<p>Email Address <select name="useremail">

    <option value="">-Select-</option>
	<?php 
	// query db to get list of player emails
		$email_query = $conn->prepare("SELECT email FROM player_roster ORDER BY email ASC");
		$email_query->execute();		
			while ($email_list = $email_query->fetch(PDO::FETCH_ASSOC)) {
	?>
			<option value="<?php echo $email_list['email']; ?>"><?php echo $email_list['email']; ?></option>
	
	<?php }	?>
	
	</select></p><br>
	
    <p><input type="submit" name="submit" value="Reset Your Pin"></p>

</form>
</body>
</html>

