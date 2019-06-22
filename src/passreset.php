<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
        p {
            text-align:center;
        }
        </style>
    </head>

<?php

require_once('pdo_connect.php');

    //Check to make sure form is empty

if (!empty($_POST['passreset'])) {
    
    //check to make sure password is confirmed
    
    if ($_POST['userpass'] == $_POST['confirmpass']) {
        
        //check to make sure all fields completed
                
        if (!empty($_POST['userpass']) && !empty($_POST['email'])) {

        //check to make sure user has correct PIN

            $email = $_POST['email'];
            $pin_check = "SELECT email, pin FROM player_roster WHERE email ='$email'";
            $pin_query = $conn->prepare($pin_check);
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
                    echo '<br><p style="font-size:20px">Password Updated Successfully</p>';
                    echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
                    exit();
                } else {
                    echo '<br><p style="font-size:20px">Problem with Password Change.  Please try again.</p>';
                    echo '<br><p style="font-size:20px;"><a href="passreset.php">Try Again</a></p>';
                    echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
                    exit();
                }
            } else {
                echo '<br><p style="font-size:20px">PIN is incorrect.  Please try again.</p>';
                echo '<br><p style="font-size:20px;"><a href="passreset.php">Try Again</a></p>';
                echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
                exit();
            }
        } else {
            echo '<br><p style="font-size:20px">Please complete all fields.</p>';
            echo '<br><p style="font-size:20px;"><a href="passreset.php">Try Again</a></p>';
            echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
            exit();
        }
    } else {
        echo '<br><p style="font-size:20px">Passwords to not match.  Please try again.</p>';
        echo '<br><p style="font-size:20px;"><a href="passreset.php">Try Again</a></p>';
        echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
        exit();
    }
}

?>

    <body>
        <br>
        <p style="font-size:25px"><b>Change your Password</b></p>

        <form action="passreset.php" method="post">
            
            <p>Email <input type="email" name="email" id="email"></p><br><br>
            
            <p>New Password <input type="password" name="userpass" id="userpass"></p><br>
            
            <p>Confirm New Password <input type="password" name="confirmpass" id="confirmpass"></p><br> 

            <p>PIN Number <input type="number" size="4" name="pin" id="pin"></p><br>
            
            <p><input type="submit" name="passreset" value="Reset Password"></p><br>

            <p><a href="pinresetfresh.php">Forgot your PIN?</a></p><br>
            
            <p><a href="../index.php">Return to Home Page</a></p>
        <form>
    </body>
</html>
