<?php

require_once('pdo_connect.php');
//require 'sendMessage.php';

if (!empty($_POST['submit'])) {

    //reset pin number in DB
    $email = $_POST['useremail'];
    $pin = rand(1000,9999);
    $pin_update =   "UPDATE player_roster 
                    SET pin = '$pin'
                    WHERE email = '$email'";
    $pin_change = $conn->prepare($pin_update);
    $pin_change->execute();

    $to = $email;
    $toName = 'Tim Brock';
    $subject = 'More testing';
    $body = '<html>

            <body>
                <h1>This is a header!</h1>
                <p>This is a paragraph!
                <br>
                <img src="http://dh.tbrock.online/db.jpg">
                <br>This is an image!
                </p>
            </body>
        </html>';
}

                

    //send_email_message($to, $toName, $subject, $body);

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
<p style="font-size:25px"><b>Select your Email to Reset PIN</b></p>
<br>
<p><a href="../index.php">Return to Home Page</a></p>
<br>

<form action="pinreset.php" method="post">

	<p>Email Address <select name="useremail">
	<option value="">-Select-</option>
	<?php 
	// query db to get list of player emails 
		$query = $conn->prepare("SELECT email FROM player_roster ORDER BY email ASC");
		$query->execute();		
			while ($email_list = $query->fetch(PDO::FETCH_ASSOC)){
	?>
	
	<option value="<?php echo $email_list['email']; ?>"><?php echo $email_list['email']; ?></option>
	
            <?php }	?>
	
    </select></p><br>
	
	<p><input type="submit" name="submit" value="Submit"></p>

</form>
</body>
</html>

