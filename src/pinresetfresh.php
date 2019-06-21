<?php

require_once('pdo_connect.php');
require_once('pinupdate.php');
require_once('sendMessage.php');

if (!empty($_POST['submit'])) {

    //set email address for update
    $email = $_POST['email'];

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

	<p>Email <input type="email" name="email" id="email"></p><br><br>
	
    <p><input type="submit" name="submit" value="Reset Your Pin"></p>

</form>
</body>
</html>

