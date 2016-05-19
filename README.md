# osticket-jasper-plugin beta 1.0.0

This is a Jasper Reports plugin for osTicket 1.9.x.  It has been used with Community Edition or Jasper Reports Server.  

Based off the unofficial osTicket Plugin Tutorial for ostEquipment (thank you).

##Installation

- You need to install the jaspersoft php library.  I used composer.
  - http://community.jaspersoft.com/wiki/php-client-sample-code
  - https://github.com/Jaspersoft/jrs-rest-php-client

- Copy dispatcher.php from scp/apps to scp.

- Drop jasper-reports into the plugin folder

- I made changes to:

  - class.osticket.php
  - staff/header.inc.php
  - staff/templates/navigation.tmpl.php
  
- Did this, https://github.com/osTicket/osTicket/issues/2349, and also did this to staff.inc.php and scp/login.php.

- I based the report query off of information I saw here, but I cleaned it up.  Just wanted to give credit.  https://github.com/elbobyhn/ReporteriaFinalOSTICKETS

**NOTE:**  The SQL in my report will be useful to you, but you will have to look at it, particularly this line:

 - - ost_list_items lsit ON SUBSTRING_INDEX(tcd.location, ' ', 1) = lsit.id
 
 list items are unique for your Enterprise.  I have a list named location.  You may not have any list.  Whatever you do, the Jasper Report included here will not work, until you adjust the SQL to match your osTicket table data.


Changed all this because this was the only way I could get all the resources to load.  This is a alpha, so it will be sketchy to run at first.

It requires the php webpage exist on the same server as the report server.  If it does not you can change help-topics.php to point to your server.  I have not yet gottent the plugin to read the value for the server from the staff menu.

The report in question is also included.  This assumes you have the Jasper Reports Server Community Edition and have configured it and have it working the way the php file expects.  Please review the code.  It is very short.

I do not know why yet, but sometimes I have to hit refresh when the search pages comes up to show the calendar images, so you can pick a date.

This is not yet a full suite.  It is an alpha.  It works and will show the way to make an integrated plugin.  However, be very careful when you upgrade osTicket, as I changed the files above.  They will surely be overwritten in a standard upgrade.
