#---begin install composer---
echo -e "\e[93minstalling composer and phpmailer..."
echo -e '\n'
echo -e "\e[93mcreating directory..."
mkdir -p ~/.php/composer
cd ~/.php/composer
echo -e "\e[93minstalling composer. if you see an error change"
echo -e "\e[93mthe install methon in configurePHPMailer.sh"
curl -sS 'https://getcomposer.org/installer' | php
#if above fails comment out and use below
#php -r "readfile('https://getcomposer.org/installer');" | php
echo -e "\e[93madding composer to PATH in .bash_profile"
echo export PATH=/home/$USER/.php/composer:\$PATH >> ~/.bash_profile
. ~/.bash_profile
echo -e "\e[93mrenaming composer.phar for easier use..."
mv ~/.php/composer/composer.phar ~/.php/composer/composer
echo -e "\e[93mcomposer install complete."
#---end install composer---
#begin install phpmailer
echo -e "\e[93m\e[93minstalling php mailer"
composer require phpmailer/phpmailer
#pull email template and test
echo -e '\n'
echo -e "\e[93mdependency installation complete."
echo -e "\e[93mbeginning email config. edit email_conf.php to change this later"
echo -e '\n'
echo -e "\e[96mwebsite hostname (omit http://. example: tbrock.online)?"
read hn
echo -e '\n'
echo -e "\e[96memail from address (email@domain.com)?"
read fr
echo -e '\n'
echo -e "\e[96memail name (John Doe)(optional)?"
read en
echo -e '\n'
echo -e "\e[96memail username?"
read un
echo -e '\n'
echo -e "\e[96memail password (will not echo to screen)?"
read -s pw
echo -e '\n'
echo -e "\e[96memail server?"
echo -e "\e[96m1)log in to Dreamhost"
echo -e "\e[96m2)Click Support-\>Data Centers in the bottom of the page"
echo -e "\e[96m3)Under the domail, check mail details for on SERVER-NAME"
echo -e "\e[96m4)Identify your email server from this list:"
echo -e "   \e[96mhomiemail-sub0 = smtp.dreamhost.com"
echo -e "   \e[96mhomiemail-sub3 = sub3.mail.dreamhost.com"
echo -e "   \e[96mhomiemail-sub4 = sub4.mail.dreamhost.com"
echo -e "   \e[96mhomiemail-sub5 = sub5.mail.dreamhost.com"
echo -e "   \e[96mhomiemail-master = homie.mail.dreamhost.com"
echo -e "\e[96myour email server?"
read sv
echo -e '\n'
echo \<?php > ~/$hn/email_conf.php
echo \$fromAddress = \'$fr\'\; >> ~/$hn/email_conf.php
echo \$fromName = \'$en\'\; >> ~/$hn/email_conf.php
echo \$emailServer = \'$sv\'\; >> ~/$hn/email_conf.php
echo \$emailUser = \'$un\'\; >> ~/$hn/email_conf.php
echo \$emailPass = \'$pw\'\; >> ~/$hn/email_conf.php
echo ?\> >> ~/$hn/email_conf.php
echo -e '\n'
echo -e '\n'
echo -e "\e[93memail config complete. pulling template files"
cd ~/$hn
wget http://dh.tbrock.online/dh-php-mailer/configurePHPMailer.zip
echo -e "\e[93mextracting template files"
unzip configurePHPMailer.zip
echo -e "\e[93mperforming cleanup..."
rm configurePHPMailer.zip
echo -e "\e[97mProcess is complete. Edit ~/$hn/emailTest.php to get started."

