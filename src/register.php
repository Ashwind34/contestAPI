<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

<?php

require_once('pdo_connect.php');
require_once('datecheck.php');

//Check to make sure form is empty

if (!empty($_POST['register'])) {
    
    //check to make sure password is confirmed
    
    if ($_POST['userpass'] == $_POST['confirmpass']) {
        
        //check to make sure all fields completed
                
        if (!empty($_POST['userpass']) && !empty($_POST['email']) && !empty($_POST['team'])) {

        //check to make sure user has correct PIN

            $email = $_POST['email'];
            $pin_check = "SELECT email, pin FROM player_roster WHERE email ='$email'";
            $pin_query = $conn->prepare($pin_check);
            $pin_query->execute();
            $pin_check_array = $pin_query->fetch(PDO::FETCH_ASSOC);

            if ($_POST['pin'] == $pin_check_array['pin']) {
            
            //Prepared Statement to update favorite team and password
            
                $query = "UPDATE player_roster 
						SET fav_team = :team,
						password = :password
						WHERE email = :email";
            
                $submit = $conn->prepare($query);
        
                //bind parameters
            
                $submit->BindParam(':email', $_POST['email']);
                $submit->BindParam(':password', password_hash($_POST['userpass'], PASSWORD_BCRYPT));
                $submit->BindParam(':team', $_POST['team']);
            
                            
                //Submit query to database

                if ($submit->execute()) {
                    echo '<br><p>Player Updated Successfully</p>';
                    echo '<br><p><a href="../index.php">Return to Home Page</a></p>';
                    exit();
                } else {
                    echo '<br><p>Problem with Registration.  Please try again.</p>';
                    echo '<br><p><a href="register.php">Try Again</a></p>';
                    echo '<br><p><a href="../index.php">Return to Home Page</a></p>';
                    exit();
                }
            } else {
                echo '<br><p>PIN is incorrect.  Please try again.</p>';
                echo '<br><p><a href="register.php">Try Again</a></p>';
                echo '<br><p><a href="../index.php">Return to Home Page</a></p>';
                exit();
            }
        } else {
            echo '<br><p>Please complete all fields.</p>';
            echo '<br><p><a href="register.php">Try Again</a></p>';
            echo '<br><p><a href="../index.php">Return to Home Page</a></p>';
            exit();
        }
    } else {
        echo '<br><p>Passwords to not match.  Please try again.</p>';
        echo '<br><p><a href="register.php">Try Again</a></p>';
        echo '<br><p><a href="../index.php">Return to Home Page</a></p>';
        exit();
    }
}

?>

	<body>
		<div class="regContainer">
			<div class="formTitle">
				PLEASE REGISTER
			</div>
			<form action="register.php" method="post">
				<div class='body'>
					Email 
					<select name="email">
						<option value="">-Select-</option>
					
						<?php 

						//query db to get list of player emails and populate select field
						$email_query = $conn->prepare("SELECT email FROM player_roster ORDER BY email ASC");
						
						$email_query->execute();
						
						$email_list = $email_query->fetchAll(PDO::FETCH_ASSOC);
						
						foreach ($email_list as $k=>$v) {                
							echo '<option value='. $v['email'] . '>' . $v['email'] . '</option>';                 
						}
								
						?>  

					</select>
					<br>
					<br>		
					
					Favorite NFL Team
					
					<select name="team">
						
						<option value="">-Select-</option>
						
						<?php 

						// query db to get list of all NFL teams 
						$team_query = $conn->prepare(
						"SELECT home AS teamlist FROM regseason WHERE week='2'
						UNION
						SELECT away AS teamlist FROM regseason WHERE week='2'
						ORDER BY teamlist ASC");
						
						$team_query->execute();	

						$team_list = $team_query->fetchAll(PDO::FETCH_ASSOC);
						
						foreach ($team_list as $k=>$v) {
							echo '<option value='. $v['teamlist'] . '>' . $v['teamlist'] . '</option>';
						}
								
						?>
						
					</select>
					<br>
					<br>
					Select Password <input type="password" name="userpass" id="userpass">
					<br>
					<br>					
					Confirm Password <input type="password" name="confirmpass" id="confirmpass">
					<br>
					<br>
					PIN Number <input type="number" size="4" name="pin" id="pin">
					<br>
					<br>
					<input type="submit" name="register" value="Register">	
				</div>
			</form>
			<div class='formLink'>
				<a href="../index.php">Return to Home Page</a>
			</div>
		</div>
	</body>
</html>
