# osticket-jasper-plugin

This is a Jasper Reports plugin for osTicket 1.9.x.  It has been used with Community Edition or Jasper Reports Server.  

Based off the unofficial osTicket Plugin Tutorial for ostEquipment (thank you).

Installation
Copy dispatcher.php from scp/apps to scp.
Drop jasper-reports into the plugin folder

I made changes to:

class.osticket.php
staff/header.inc.php
staff/templates/navigation.tmpl.php


This was the only way I could get all the resources to load.  This is a alpha, so it will be sketchy to run at first.

It requires the php webpage exist on the same server as the report server.  If it does not you can change help-topics.php to point to your server.  I have not yet gottent the plugin to read the value for the server from the staff menu.

The report in question is also included.  This assumes you have the Jasper Reports Server Community Edition and have configured it and have it working the way the php file expects.  Please review the code.  It is very short.




