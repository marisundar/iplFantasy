<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 

$TEAM_ID=$_POST['TEAM_ID'];
$PLAYER_ID=$_POST['PLAYER_ID'];

// Connect to server and select databse.


$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 
$sql_pat="INSERT INTO b16_16587264_ipl.`team_players`(`TEAM_ID`, `PLAYER_ID`, `SOLD_AMOUNT`, `START_DATE`, `END_DATE`, `VALID_IND`, `POWER_PLAYER`) VALUES ($TEAM_ID,$PLAYER_ID,0,NOW(),'2017-04-14 14:26:20','Y',1)";
//
echo $sql_pat;
    $result_pat=mysqli_query($con,$sql_pat);


?>