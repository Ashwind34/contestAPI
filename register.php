
<?php

require_once('pdo_connect.php');


	
	//Check to make sure form is empty

if (!empty($_POST['register'])) {
	
	//check to make sure password is confirmed
	
	if ($_POST['userpass'] == $_POST['confirmpass']) {
		
		//check to make sure all fields completed
		
		if(!empty($_POST['userpass']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) 
		&& !empty($_POST['uname']) && !empty($_POST['team'])) {
			
		//Prepared Statement 
		
		$submit = $conn->prepare("REPLACE INTO player_roster (first_name, last_name, user_name, email, password, fav_team) 
					VALUES (:fname, :lname, :uname, :email, :password, :team)");
		
		//Bind Parameters
		
		$submit->BindParam(':fname', $_POST['fname']);
		$submit->BindParam(':lname', $_POST['lname']);
		$submit->BindParam(':uname', $_POST['uname']);
		$submit->BindParam(':email', $_POST['email']);
		$submit->BindParam(':password', password_hash($_POST['userpass'], PASSWORD_BCRYPT));
		$submit->BindParam(':team', $_POST['team']);
		
			
		

				
		//Submit query to database

			if ($submit->execute()) {
				echo "User Added Successfully";
				echo '<br><a href="index.php">Return to Home Page</a>';
				} else {
				echo "Registration failed.  Please try again."; 
			}
		}
	} else {
			echo "Password does not match.  Please try again.";
		}
} else {		
	

	
	



?>
<!DOCTYPE HTML>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
p
{
	text-align:center;

}
</style>
<body>

<br>
<p style="font-size:25px"><b>PLEASE REGISTER</b></p>
<br>
<br>

<form action="register.php" method="post">
	
	
	
	<!-- MUST UPDATE DB CONNECTION AND INSERT STATEMENT TO PDO TO USE DROPDOWN MENUS -->
	
	<p>Email Address <select name="email">
	<option value="">-Select-</option>
	<?php 
	// query db to get list of player emails
		$query = $conn->prepare("SELECT email FROM player_roster");
		$query->execute();		
			while ($email_list = $query->fetch(PDO::FETCH_ASSOC))
			{
	?>
	
	<option value="<?php echo $email_list['email']; ?>"><?php echo $email_list['email']; ?></option>
	<?php 
	
			}
			
			
	?>
	</select></p><br>
	
	<p>First Name <input type="text"  name="fname" id="fname"></p><br><br>
	
	<p>Last Name  <input type="text" name="lname" id="lname"></p><br><br>
	
	<p>Favorite NFL Team <select name="team">
	<option value="">-Select-</option>
	<?php 
	// query db to get list of all NFL teams 
		$teamquery = $conn->prepare(
		"SELECT home AS teamlist FROM regseason WHERE week='1'
		UNION
		SELECT away AS teamlist FROM regseason WHERE week='1'
		ORDER BY teamlist ASC");
		$teamquery->execute();		
			while ($nfl_teams = $teamquery->fetch(PDO::FETCH_ASSOC))
			{
	?>
	
	<option value="<?php echo $nfl_teams['teamlist']; ?>"><?php echo $nfl_teams['teamlist']; ?></option>
	<?php 
	
			}
			
			
	?>
	</select></p><br> 
	
	<p>Select User Name <input type="text" name="uname" id="uname"><p><br><br>
	
	<p>Your Password <input type="password" name="userpass" id="userpass"></p><br><br>
	
	<p>Confirm Password <input type="password" name="confirmpass" id="confirmpass"></p><br><br> 
	
	<p><input type="submit" name="register" value="Register"></p>
<form>



</body>
<?php }  ?>

</html>