
<?php

require_once('mysqli_connect.php');
	
	//Check to make sure all fields completed

if ($_POST['userpass'] == $_POST['confirmpass']) {
	
	if(!empty($_POST['userpass']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['useremail']) 
	&& !empty($_POST['uname']) && !empty($_POST['team'])) {
		
	//DB query to enter form data

	$query = "INSERT INTO player_roster (first_name, last_name, user_name, email, password, fav_team) 
				VALUES ( ? , ? , ? , ? , ? , ? )";
	
	//Prepared Statement
	
	$stmt = $conn->prepare($query);
	
	//Bind Parameters
	
	$stmt->bind_param('ssssss', $_POST['fname'], $_POST['lname'], $_POST['uname'], 
			$_POST['useremail'], PASSWORD_HASH($_POST['userpass'], PASSWORD_DEFAULT), $_POST['team']);
	
			
	//Submit query to database

		if ($stmt->execute()) {
			echo "User Added Successfully";
			echo '<br><a href="index.php">Return to Home Page</a>';
			} else {
			echo ("Registration Failed, Error is: " . mysqli_error($conn)); 
		}
	}
} else {
		echo "Password does not match.  Please try again.";
	}	

	
	

mysqli_close($conn);

?>
<!DOCTYPE HTML>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<br>
<br>
<br>

<form action="register.php" method="post">
	
	First Name <input type="text" value="<?php if( isset($_POST['fname'])){ echo $_POST['fname'];} ?>" name="fname" id="fname"><br><br>
	Last Name  <input type="text" name="lname" id="lname"><br><br>
	
	<!-- MUST UPDATE DB CONNECTION AND INSERT STATEMENT TO PDO TO USE DROPDOWN MENUS -->
	
	<!-- <p>Email Address <select name="useremail">
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
	
	<p>Favorite NFL Team <select name="useremail">
	<option value="">-Select-</option>
	<?php 
	// query db to get list of all NFL teams 
		$query = $conn->prepare(
		"SELECT home AS teamlist FROM regseason WHERE week='1'
		UNION
		SELECT away AS teamlist FROM regseason WHERE week='1'
		ORDER BY teamlist ASC");
		$query->execute();		
			while ($nfl_teams = $query->fetch(PDO::FETCH_ASSOC))
			{
	?>
	
	<option value="<?php echo $nfl_teams['teamlist']; ?>"><?php echo $nfl_teams['teamlist']; ?></option>
	<?php 
	
			}
			
			
	?>
	</select></p><br> -->
	Select User Name <input type="text" name="uname" id="uname"><br><br>
	Your Password <input type="password" name="userpass" id="userpass"><br><br>
	Confirm Password <input type="password" name="confirmpass" id="confirmpass"><br><br> 
	<input type="submit" name="register" value="Register">
<form>

</body>


</html>