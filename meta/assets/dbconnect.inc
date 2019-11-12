<?php
//purpose: hold specific login data for database connections
//security: the directory where this file lives must have .htaccess file allowing only calls from php files to have read access to it.

$dbConn = new mysqli('localhost', , , $database);
$dbConn->set_charset('utf-8');

if ($dbConn->connect_errno) {
	die('Unable to connect to the database [' . $dbConn->connect_error . ']');
}

?>
