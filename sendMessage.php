<?php

//include the email config file
//include 'email_conf.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email_message($recipientEmail, $recipientName, $subject, $body)
{
    require 'email_conf.php';

    try {
        //Load composer's autoloader
        require '/home/' . get_current_user() . '/.php/composer/vendor/autoload.php';
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

        //Server settings
        //$mail->SMTPDebug = false;           //disable mail debug logging. otherwise email results are in error.log
        //$mail->do_debug = 0;                //also disable debug logging
        $mail->Debugoutput = 'error_log';
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $emailServer;                   // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $emailUser;                 // SMTP username
        $mail->Password = $emailPass;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        if($fromName === NULL) {
        $mail->setFrom($fromAddress);
        } else {
            $mail->setFrom($fromAddress, $fromName);
        }

        
    //Recipients
    //$mail->addAddress('contact@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        $mail->addAddress($recipientEmail, $recipientName);     // Add a recipient
        $mail->Subject = $subject;
        $mail->Body = $body;
    
    //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        
        
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        $emailLog = '/home/' . get_current_user() . '/email_custom.log';
        $handle = fopen($emailLog, 'a') or die('Cannot open file:  ' . $emailLog); //create/open in append mode

    echo 'Message has been sent';
        //fwrite($handle, 'Message has been sent');
    } catch (Exception $e) {
    echo 'Message could not be sent.';
        //fwrite($emailLog, 'Message could not be sent.');
    echo 'Mailer Error: ' . $mail->ErrorInfo;
        //fwrite($emailLog, 'Mailer Error: ' . $mail->ErrorInfo);


    }

}

?>