
<?php

require_once('pdo_connect.php');
require_once('pinupdate.php');

if (!empty($_POST["select"])) {
    $emailstoreset = $_POST["select"];
    $emailbody = $_POST["msgbody"];

    foreach ($emailstoreset as $email) {
        PinUpdate($email);
    }
        
}
?>

<!-- NEED TO USE THIS FORM TO CREATE A PHP ARRAY OF EMAILS TO FEED INTO LOOP FOR PINUPDATE FUNCTION -->
<html>
        <form action="pinresetall.php" method="POST">
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
                <input type="submit" value="Submit">
        </form>
</html>