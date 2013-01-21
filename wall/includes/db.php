<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'nmazuz_bizzer');
define('DB_PASSWORD', 'niso7265');
define('DB_DATABASE', 'nmazuz_bizzer');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
