<?php 

require_once('emailcheck.php');
require_once('gamecheck.php');
require_once('dupeteamcheck.php');
require_once('pdo_connect.php');
require_once('datecheck.php');


if(!empty($_POST['submit'])) {

    $dupe = dupeCheck($_POST);
    $game = gameCheck($_POST);

    echo $fake_date . '<br>';
    print_r($_POST);
    print '<br>';
    print 'DupeTeamCheck: ' . dupeCheck($_POST) . '<br>';
    print 'GameCheck:' . gameCheck($_POST) . '<br>';
    print 'TimeCheck:' . timeCheck($_POST) . '<br>';

    


}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
    <body>
        <div class="wrapper">
            <div class="regContainer">
                <div class="formTitle">
                    TEST
                </div>
                <form action="functioncheck.php" method="post">
                    <label for="pick1">pick1</label>
                    <input type="text" name="pick1" id="pick1">
                    <label for="pick2">pick2</label>
                    <input type="text" name="pick2" id="pick2">
                    <label for="pick3">pick3</label>
                    <input type="text" name="pick3" id="pick3">
                    <label for="pick4">pick4</label>
                    <input type="text" name="pick4" id="pick4">
                    <label for="pick5">pick5</label>
                    <input type="text" name="pick5" id="pick4">
                    <input type="submit" name="submit" value="test">	
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
        <?php phpinfo(); ?>
	</body>
</html>