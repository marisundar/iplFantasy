<?php

// Connection to the database
$hostname = "localhost";
$database = "b16_16587264_arun";
$username = "b16_16587264";
$password = "vaira1129"; //password not required for wamp, so put this $password = "";

$conn = mysql_connect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
