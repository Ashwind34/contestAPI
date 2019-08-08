<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

<?php

require_once('pdo_connect.php');
require_once('emailcheck.php');

$tryAgain =     '<br><p><a href="register.php">Try Again</a></p>
                <br><p><a href="../index.php">Return to Home Page</a></p>
                <audio src="../css/audio/nogood.mp3" id="page_audio"></audio>
                <script src="../audio.js"></script>';

//Check to make sure form is empty

if (!empty($_POST['register'])) {
    
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
                
                //Prepared Statement to update password
                
                    $query = "UPDATE player_roster 
                            SET password = :password
                            WHERE email = :email";
                
                    $submit = $conn->prepare($query);
            
                    //bind parameters
                
                    $submit->BindParam(':email', $_POST['email']);
                    $submit->BindParam(':password', password_hash($_POST['userpass'], PASSWORD_BCRYPT));       
                                
                    //Submit query to database

                    if ($submit->execute()) {
                        echo    '<br><p>Player Updated Successfully</p>
                                <br><p><a href="./login.php">Log In</a></p>
                                <audio src="../css/audio/firstdown.mp3" id="page_audio"></audio>
                                <script src="../audio.js"></script>';
                        exit();
                    } else {
                        echo '<br><p>Problem with Registration.  Please try again.</p>';
                        echo $tryAgain;
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
            <div class="regContainer">
                <div class="formTitle">
                    PLEASE REGISTER
                </div>
                <form action="register.php" method="post">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                    <label for="userpass">Select Password</label>
                    <input type="password" name="userpass" id="userpass">
                    <label for="confirmpass">Confirm Password</label>
                    <input type="password" name="confirmpass" id="confirmpass">
                    <label for="pin">PIN</label>
                    <input type="number" size="4" name="pin" id="pin">
                    <input type="submit" name="register" value="Register">	
                </form>
                <div class='formLink'>
                    <br>
                    <br>
                    <a href="../index.php">Return to Home Page</a>
                    <br>
                    <br>
                </div>
            </div>
        </div>
	</body>
</html>
