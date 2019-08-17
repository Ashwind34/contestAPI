<?php 

session_start();

require_once('pdo_connect.php');
require_once('emailcheck.php');

if(isset($_SESSION['player_id']) && !empty($_SESSION['player_id'])) {

	echo '<script type="text/javascript">window.location.href="./home.php"</script>';

}


?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

<?php

if (!empty($_POST['userpass']) && !empty($_POST['useremail'])) {

    $email = $_POST['useremail'];

    if (emailCheck($email)) {    

        $record = $conn->prepare("SELECT player_id, email, password, first_name FROM player_roster WHERE email = :email");
        $record->bindParam(':email', $_POST['useremail']);
        $record->execute();    
        $result = $record->fetch(PDO::FETCH_ASSOC);
    
        //check password entered by user against db password, set session if match
        if (COUNT($result) > 0 && password_verify($_POST['userpass'], $result['password'])) {
            $_SESSION['player_id'] = $result['player_id'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['name'] = $result['first_name'];
    
            // redirect to index.php without using header()
            $URL = "home.php";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        } else {
            echo '<br><br><p>Email or password is incorrect.  Please try again.</p>
                <br><p><a href="login.php">Try Again</a></p>
                <br><p><a href="../index.php">Return to Home Page</a></p>
                <audio src="../css/audio/nogood.mp3" id="page_audio"></audio>
                <script src="../audio.js"></script>';
            exit();
        }
    } else {
        email_error(basename(__FILE__));
    }
}
?>

	<body>
        <div class="wrapper">
            <div class='loginContainer'>
                <div class='formTitle'>
                    PLEASE LOG IN
                </div>
                <form action="login.php" method="post">
                    <label for='useremail'>Email</label>
                    <input type="email" name="useremail" id="useremail">
                    <label for='userpass'>Password</label>
                    <input type="password" name="userpass" id="userpass">          
                    <input type="submit" name="login" value="Login">
                </form>
                <div class='formLink'>
                    <br>
                    <a href="passreset.php">Change Password</a>
                    <a href="../index.php">Return to Home Page</a>
                </div>
            </div>
        </div>
	</body>
</html>