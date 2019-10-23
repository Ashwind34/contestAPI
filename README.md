# The NFL Supercontest App
This is my application to administer an NFL picks contest with remote users.  Contest participants pick 5 NFL games per week, and the application calculates weekly scores for each player and maintains a leaderboard for the contest.  The application was built using HTML, CSS, MySQL, and PHP.  This project was born out of a need to run this contest with multiple participants without keeping track of player picks and scores with spreadsheets.  The current css theme for this project is styled after the 1991 video game Tecmo Super Bowl for the original Nintendo Entertainment System. 

## Requirements

- A web server running PHP 7.0+
- A MySQL database
- Access to an email server and email account that can be used with PHPMailer (Gmail works fine)

## Usage

1) First, you will need to create a new MySQL database.  I have included a .sql file to help initialize the database. Once you have created your database, log into your server and use the following command: 

    mysql -u <username> -p <password> <new_database_name> < path/to/supercontest.sql.

2) The application was designed to be used by a private group.  Therefore, you will need to manually import the first name, last name, and email address of each contest participant into the player_picks table.  

3) Admin level control is available to the first 2 users listed in the player_picks table.  This can be altered in the index.php file.  Players who have admin access will have an additional link on their home page that will take them to the admin panel.

4) Update the src/creds.php file with your database credentials.

5) This application uses PHPMailer.  Update the src/email_conf.php file with your email account and email server credentials.

6) Generate PINs for each player using the RESET PLAYER PINS link in the admin panel.  Players will need a PIN to register.  PINs are emailed to each participant at the beginning of the season, and whenever a player requests a new PIN.  PINs are necessary for security to ensure that the individual player is the only person who can change his or her password.

7) Game lines, game scores, and the current week need to be updated manually using the UPDATE LINES AND SCORES link in the admin panel.


Thanks for looking at my application!  Please feel free to leave any feedback.  Enjoy!

Pending items to update:

- Continue separating business logic from views
- Consolidate and re-organize some business logic
- Re-factor using additional OOP techniques
