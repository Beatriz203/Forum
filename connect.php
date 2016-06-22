<?php 
session_start();
//connect.php
$server	    = 'db.ist.utl.pt';
$username	= 'ist173150';
$password	= 'jjia4691';
$database	= $username;

if(!mysql_connect($server, $username, $password))
{
 	exit('Error: could not establish database connection');
}
if(!mysql_select_db($database))
{
 	exit('Error: could not select the database');
}
?>
