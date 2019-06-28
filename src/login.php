<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

<?php

session_start();

require_once('pdo_connect.php');

if (!empty($_POST['userpass']) && !empty($_POST['useremail'])) {
    
//PDO prepared statement
    $record = $conn->prepare("SELECT player_id, email, password FROM player_roster WHERE email = :email");
    $record->bindParam(':email', $_POST['useremail']);
    $record->execute();
    
    //create associative array from query
    $result = $record->fetch(PDO::FETCH_ASSOC);
    
    //check password entered by user against db password, set session if match
    if (COUNT($result) > 0 && password_verify($_POST['userpass'], $result['password'])) {
        $_SESSION['player_id'] = $result['player_id'];
    
        // redirect to index.php without using header()
        $URL = '../index.php';
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    } else {
        echo '<br><br><p>Email or password is incorrect, please try again</p>';
        echo '<br><p><a href="login.php">Try Again</a></p>';
        echo '<br><p><a href="../index.php">Return to Home Page</a></p>';
        exit();
    }
}
?>

	<body>
        <div class='loginContainer'>
            <div class='formTitle'>
                PLEASE LOG IN
            </div>
            <form action="login.php" method="post">
                <label for='useremail'>Email</label>
                <input type="email" name="useremail" id="useremail"><br>
                <label for='userpass'>Password</label>
                <input type="password" name="userpass" id="userpass"><br>          
                <input type="submit" name="login" value="Login">
            </form>
            <div class='formLink'>
                <a href="passreset.php">Change Password</a>
                <br>
                <a href="../index.php">Return to Home Page</a>
            </div>
        </div>
	</body>
</html>