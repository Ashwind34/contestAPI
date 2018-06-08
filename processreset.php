<?php
//header("Content-Type: text/html");

foreach ($_POST['select'] as $email) {
        $pin = rand(1000,9999);

        
        $id = $_SESSION['player_id'];
		
		$pinUpdate = 
		
		
		/*
		ADD SQL INSERT UPDATE STATEMENT TO ADD PIN TO DB
        */
        $body = $_POST['msgbody'] . '/ pin: ' . $pin . '<br>';
        $subject = 'Supercontest Registration';
		$sender = 'thecommish@nfl-supercontest.com';
        echo 'email address: ' . $email . '/ pin: ' . $pin . '<br>';
        echo 'email recipient: ' . $email . '<br>';
        echo 'email sender: ' . $sender . '<br>';
        echo 'email subject: ' . $subject . '<br>';
        echo 'email body: ' . $body . '<br>';
		
}
        //USE PHPMAILER TO GENERATE EMAIL FROM DREAMHOST (OR GMAIL) ACCOUNT BASED ON THESE RESULTS
        //IN EMAIL BODY, ADD GENERIC MESSAGE WITH LINK TO REGISTER.PHP AND EMAIL ALREADY PRE-FILLED
		//ADD FORM FIELD TO REGISTER.PHP TO INCLUDE PIN INPUT
		

			/**
			* This example shows making an SMTP connection with authentication.
			*/

			//SMTP needs accurate times, and the PHP timezone MUST be set
			//This should be done in your php.ini, but this is how to do it if you don't have access to that
			date_default_timezone_set('Etc/UTC');

			require('PHPmailer-master/src/PHPMailer.php');
			//Create a new PHPMailer instance
			$mail = new PHPMailer;

			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 2;
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';

			//Set the hostname of the mail server
			$mail->Host = "sub5.mail.dreamhost.com";
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port = 587;
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			//Username to use for SMTP authentication
			$mail->Username = "thecommish@nfl-supercontest.com";
			//Password to use for SMTP authentication
			$mail->Password = "Cheese10";
			//Set who the message is to be sent from
			$mail->setFrom('$sender', 'SuperContest Admin');
			//Set an alternative reply-to address
			//$mail->addReplyTo('replyto@example.com', 'First Last');
			//Set who the message is to be sent to
			$mail->addAddress('$email');

			//Set the subject line
			$mail->Subject = 'PHPMailer SMTP test';
			//if you want to include text in the body. 
			$mail->Body    = "This is a test of email";

			//send the message, check for errors
			if (!$mail->send()) {
			   echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			   echo "Message sent!";
			}
			?>




