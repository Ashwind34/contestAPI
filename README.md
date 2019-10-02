# The NFL Supercontest App
This is my application to administer an NFL picks contest using HTML, CSS, MySQL, and PHP.  This project was born out of a need to run this contest with multiple participants without keeping track of player picks and scorekeeping with spreadsheets.  The current css theme for this project is styled after the 1991 video game Tecmo Super Bowl for the original Nintendo Entertainment System.

You can clone this repo into any web server running PHP 7.0+ to begin.

On your MySQL server, create a new database and import the supercontest.sql file to generate the database.  The current file includes each game from the 2019 NFL Season.  You will want to remove this data dump from the .sql file and manually load data in a similar structure to use this application for future seasons.  You will also need to update the season start date in the datecheck.php file (line 13).

You will need to enter your database credentials in the creds.php file.

The application uses PHPMailer for core functionality.  You will need to enter your email server credentials in the email_conf.php file.

If you intend to have any prizes, you will need to modify payouts.php to correctly display your prize schedule.  You can also remove this page altogether by deleting the link from home.php.

## Usage

The application was designed to be used by a private group.  Therefore, you will need to manually import the first name, last name, and email address of each contest participant into the player_picks table.  

Admin level control is available to the first 2 users listed in the player_picks table.  This can be altered in the index.php file.  Players who have admin access will have an additional link on their home page that will take them to the admin panel.

Once you have loaded your list of participants, you will need to generate a PIN for each of them.  This can be done by accessing the RESET PLAYER PINS page from the admin panel.  When you are ready to begin, you will need to select all of the participants and click the submit button.  This will create a new PIN number in the database and email it to each individual player.  You will then need to instruct each player to go to the Register page and use their PIN to set up their account.  

Once all of your players have registered, you can begin the contest.  You will need to manually set the NFL week season in the admin panel by going to the UPDATE LINES AND SCORES page.  I added the requirement to change the week manually in order to allow for admins to "roll back" the season in order to correct any data entry mistakes.

Before you can begin, you will need to manually input the point spreads for each team in the UPDATE LINES AND SCORES page.  Note that you will need to enter a spread for EACH team, not just for each game (I am working on fix for this).  Once you have input ONLY point spreads for each game,click submit to update the schedule with point spreads. 

Once you have entered the point spreads, your players can make their picks by clicking on the MAKE YOUR PICKS link in the main menu.  There are several validation checks that run to ensure that players cannot cheat.  Once a game has started, it will not be available for players to select.  Also, players cannot select both teams from the same game, and players cannot select the same team twice.  Also, each time a player makes a submission, that pick is logged in the database as an audit trail.  Only the players' most recent submission will be scored.

After the final game for the week has been completed, you will need to return to the UPDATE LINES AND SCORES page on the admin panel to update the scores for that week (I intend to update this process using 3rd party API calls in the future).  Once you have entered the scores for each team, click submit.  NOTE: Clicking submit also updates each players contest score, so make sure that you enter the data correctly before clicking submit.  Otherwise you will need to go back and make a correction.

Thanks for looking at my application!  Please feel free to leave any feedback.  Enjoy!

Pending items to update:

- Continue separating business logic from views
- Consolidate and re-organize some business logic
- Re-factor using additional OOP techniques
