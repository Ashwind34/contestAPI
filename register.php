<!DOCTYPE HTML>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
p
{
	text-align:center;

}
</style>
<body>

<?php

require_once('pdo_connect.php');
require_once('datecheck.php');

	//Check to make sure form is empty

if (!empty($_POST['register'])) {
	
	//check to make sure password is confirmed
	
	if ($_POST['userpass'] == $_POST['confirmpass']) {
		
		//check to make sure all fields completed
				
		if(!empty($_POST['userpass']) && !empty($_POST['email']) && !empty($_POST['team'])) {

		//check to make sure user has correct PIN

		$email = $_POST['email'];
		$pin_check = "SELECT email, pin FROM player_roster WHERE email ='$email'";
		$pin_query = $conn->prepare($pin_check);
		$pin_query->execute();
		$pin_check_array = $pin_query->fetch(PDO::FETCH_ASSOC);

			if ($_POST['pin'] == $pin_check_array['pin']){
			
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
					echo '<br><p style="font-size:20px">Player Updated Successfully</p>';
					echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
					
				} else {
					
					echo '<br><p style="font-size:20px">Problem with Registration.  Please try again.</p>';
					echo '<br><p style="font-size:20px;"><a href="register.php">Try Again</a></p>';
					echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
					
				}

			} else {	
				echo '<br><p style="font-size:20px">PIN is incorrect.  Please try again.</p>';
				echo '<br><p style="font-size:20px;"><a href="register.php">Try Again</a></p>';
				echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
			}	

			
		} else {
			
			echo '<br><p style="font-size:20px">Please complete all fields.</p>';
			echo '<br><p style="font-size:20px;"><a href="register.php">Try Again</a></p>';
			echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
			
		}
		
	} else {
		
		echo '<br><p style="font-size:20px">Passwords to not match.  Please try again.</p>';
		echo '<br><p style="font-size:20px;"><a href="register.php">Try Again</a></p>';
		echo '<br><p style="font-size:20px;"><a href="../index.php">Return to Home Page</a></p>';
			
	}

} 
?>


<br>
<p style="font-size:25px"><b>PLEASE REGISTER</b></p>

<form action="register.php" method="post">
	
	<p>Email Address <select name="email">
	<option value="">-Select-</option>
	<?php 
	// query db to get list of player emails
		$email_query = $conn->prepare("SELECT email FROM player_roster ORDER BY email ASC");
		$email_query->execute();		
			while ($email_list = $email_query->fetch(PDO::FETCH_ASSOC)) {
	?>
			<option value="<?php echo $email_list['email']; ?>"><?php echo $email_list['email']; ?></option>
	
	<?php }	?>
	
	</select></p><br>
	
	<p>Favorite NFL Team <select name="team">
	<option value="">-Select-</option>
	<?php 
	// query db to get list of all NFL teams 
		$team_query = $conn->prepare(
		"SELECT home AS teamlist FROM regseason WHERE week='2'
		UNION
		SELECT away AS teamlist FROM regseason WHERE week='2'
		ORDER BY teamlist ASC");
		$team_query->execute();		
			
			while ($nfl_teams = $team_query->fetch(PDO::FETCH_ASSOC)) {
	?>
	
				<option value="<?php echo $nfl_teams['teamlist']; ?>"><?php echo $nfl_teams['teamlist']; ?></option>
	
	<?php 	}	?>
	
	</select></p><br> 
	
	<p>Your Password <input type="password" name="userpass" id="userpass"></p><br>
	
	<p>Confirm Password <input type="password" name="confirmpass" id="confirmpass"></p><br> 

	<p>PIN Number <input type="number" size="4" name="pin" id="pin"></p><br>
	
	<p><input type="submit" name="register" value="Register"></p><br>
	
	<p><a href="../index.php">Return to Home Page</a></p>
<form>



</body>
</html>
