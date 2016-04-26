<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$PLAYER_ID=$_POST['PLAYER_ID'];

// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

$sql_pat="UPDATE b16_16587264_ipl.team_players SET END_DATE=NOW() WHERE PLAYER_ID =$PLAYER_ID AND NOW() BETWEEN START_DATE AND END_DATE";
    $result_pat=mysqli_query($con,$sql_pat);
?>

