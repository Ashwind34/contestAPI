
<?php

require_once('pdo_connect.php');

	
		
//Manual email list for testing if needed
//$users = array("phxxxx@gmail.com", "ahester34@gmail.com");

if (!empty($_POST['submit'])) {
	header ("Location: /processreset.php");
	}
		
?>

<html>
        <form action="processreset.php" method="POST">
                <select multiple size="20" name="select[]">
                    <?php 
					// query db to get list of player emails
						$email_query = $conn->prepare("SELECT email FROM player_roster ORDER BY email ASC");
						$email_query->execute();		
							while ($email_list = $email_query->fetch(PDO::FETCH_ASSOC)) {
							
					?>
					
								<option value="<?php echo $email_list['email']; ?>"><?php echo $email_list['email']; ?></option>
					
					<?php 	}	?>  
                </select>
                <br>
                <textarea name="msgbody" rows="5" cols="20">Greetings, note your registration pin and clink to register</textarea><br>
                <input type="submit" value="Send Reset PINs">
        </form>
</html>