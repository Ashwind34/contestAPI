<?php

//include the email config file
//include 'email_conf.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_email_message($recipientEmail, $recipientName, $subject, $body)
{
    // import email settings
    require 'email_conf.php';

    try {

        //Load composer's autoloader
        require '/home/' . get_current_user() . '/.php/composer/vendor/autoload.php';
        
        $mail = new PHPMailer(true);                            // Passing `true` enables exceptions

        //Server settings
        $mail->Debugoutput = 'error_log';
        $mail->SMTPDebug = 2;                                   // Enable verbose debug output
        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->Host = $emailServer;                             // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                  // Enable SMTP authentication
        $mail->Username = $emailUser;                           // SMTP username
        $mail->Password = $emailPass;                           // SMTP password
        $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                      // TCP port to connect to
        if($fromName === NULL) {
        $mail->setFrom($fromAddress);
        } else {
            $mail->setFrom($fromAddress, $fromName);
        }      
        $mail->addAddress($recipientEmail, $recipientName);     // Add a recipient
        $mail->Subject = $subject;
        $mail->Body = $body;
    
        //Content
        $mail->isHTML(true);                                    // Set email format to HTML    
        $mail->send();

        echo '<br><p style="font-size:20px;">A new PIN has been sent to ' . $recipientEmail . '. Check your email!</p>';
        echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
        exit();
    
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        echo '<br><p style="font-size:20px">Message could not be sent.  Please try again.</p>';
        echo '<br><p>Mailer Error: ' . $mail->ErrorInfo . '.  Please email this error to the Commissioner.';
        echo '<br><p style="font-size:20px;"><a href="pinresetfresh.php">Try Again</a></p>';
        echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
        exit();  
    }

}

?>