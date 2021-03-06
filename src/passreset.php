<?php 

session_start();

require_once('sessioncheck.php');
require_once('pdo_connect.php');
require_once('emailcheck.php');

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Reset Password
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>

<?php

$player_email = $_SESSION['email'];

$tryAgain =     '<br><p><a href="passreset.php">Try Again</a></p>
                <br><p><a href="../index.php">Return to Home Page</a></p>
                <audio src="../css/audio/nogood.mp3" id="page_audio"></audio>
                <script src="../audio.js"></script>';

//Check to make sure form is empty

if (!empty($_POST['passreset'])) {
    
    //check to make sure password is confirmed
    
    if ($_POST['userpass'] == $_POST['confirmpass']) {
        
        //check to make sure all fields completed
                
        if (!empty($_POST['userpass']) && !empty($_POST['email'])) {

            //check email is in the contest

            $email = $_POST['email'];
        
            if (emailCheck($email)) {
                
                //check to make sure user has correct PIN  

                $pin_check = "SELECT email, pin FROM player_roster WHERE email = :email";
                $pin_query = $conn->prepare($pin_check);
                $pin_query->BindParam(':email', $email);
                $pin_query->execute();
                $pin_check_array = $pin_query->fetch(PDO::FETCH_ASSOC);
    
                if ($_POST['pin'] == $pin_check_array['pin']) {
                
                    $query = "UPDATE player_roster 
                            SET password = :password
                            WHERE email = :email";
                
                    $submit = $conn->prepare($query);
                
                    $submit->BindParam(':email', $_POST['email']);
                    $submit->BindParam(':password', password_hash($_POST['userpass'], PASSWORD_BCRYPT));
    
                    if ($submit->execute()) {
                        echo    '<br><p>Password Updated Successfully</p>
                                <br><p><a href="../index.php">Return to Home Page</a></p>
                                <audio src="../css/audio/extrapoint.mp3" id="page_audio"></audio>
                                <script src="../audio.js"></script>';
                        exit();
                    } else {
                        echo '<br><p>Problem with Password Change.  Please try again.</p>';                    
                        echo $tryagain;
                        exit();
                    }
                } else {
                    echo '<br><p>PIN is incorrect.  Please try again.</p>';
                    echo $tryAgain;
                    exit();
                }
            } else {
                email_error(basename(__FILE__));
            }
        } else {
            echo '<br><p>Please complete all fields.</p>';
            echo $tryAgain;
            exit();
        }
    } else {
        echo '<br><p>Passwords to not match.  Please try again.</p>';
        echo $tryAgain;
        exit();
    }
}

?>

    <body>
        <div class="wrapper">
            <div class="resetContainer">
                <div class="formTitle">
                    Change your Password
                </div>
                <form action="passreset.php" method="post">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $player_email; ?>">

                    <label for="userpass">New Password</label>                
                    <input type="password" name="userpass" id="userpass">

                    <label for="confirmpass">Confirm Password</label>                
                    <input type="password" name="confirmpass" id="confirmpass">

                    <label for="pin">PIN</label>
                    <input type="number" size="4" name="pin" id="pin"> 
                                
                    <input type="submit" name="passreset" value="Reset Password">
                </form>
                <div class="formLink">
                    <a href="pinreset.php">Reset PIN</a>         
                    <a href="../index.php">Return to Home Page</a>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </body>
</html>
