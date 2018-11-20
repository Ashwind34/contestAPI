<?php

require 'sendMessage.php';

$to = 'phxxxx@gmail.com';
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

			

send_email_message($to, $toName, $subject, $body);

?>

