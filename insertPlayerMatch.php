<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$MATCH_ID=$_POST['MATCH_ID'];
$PLAYER_ID=$_POST['PLAYER_ID'];
$SIX=$_POST['SIX'];
$FOUR=$_POST['FOUR'];
$RUNS=$_POST['RUNS'];
$WICKETS=$_POST['WICKETS'];
$OVERS=$_POST['OVERS'];
$RUNOUT=$_POST['RUNOUT'];
$STUMPING=$_POST['STUMPING'];
$MAIDEN=$_POST['MAIDEN'];
$CATCHES=$_POST['CATCHES'];
$PLAYED_DATE=$_POST['PLAYED_DATE'];
$MATCH_INFO=$_POST['MATCH_INFO'];
$BATSMANBALLS=$_POST['BATSMANBALLS'];
$BOWLINGRUNS=$_POST['BOWLINGRUNS'];
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 
$sql_pat="delete from `b16_16587264_ipl`.player_batting_info where MATCH_ID='$MATCH_ID' AND PLAYER_ID='$PLAYER_ID'";
    $result_pat=mysqli_query($con,$sql_pat);
$sql_pat="delete from `b16_16587264_ipl`.player_fielding_info where MATCH_ID='$MATCH_ID' AND PLAYER_ID='$PLAYER_ID'";
    $result_pat=mysqli_query($con,$sql_pat);	
	
	
	$sql_pat="insert into `b16_16587264_ipl`.player_batting_info(PLAYER_ID,MATCH_ID,PLAYED_DATE,NO_OF_SIX,NO_OF_FOUR,TOTAL_RUNS,BATSMANBALLS) values('$PLAYER_ID','$MATCH_ID','$PLAYED_DATE','$SIX','$FOUR','$RUNS','$BATSMANBALLS')";
    $result_pat=mysqli_query($con,$sql_pat);
	
	$sql_pat="insert into `b16_16587264_ipl`.player_fielding_info(PLAYER_ID,MATCH_ID,PLAYED_DATE,NO_OF_WICKETS,NO_OF_OVERS,NO_OF_RUNOUTS,NO_OF_STUMPING,NO_OF_MAIDEN,NO_OF_CATCHES,BOWLINGRUNS) values('$PLAYER_ID','$MATCH_ID','$PLAYED_DATE','$WICKETS','$OVERS','$RUNOUT','$STUMPING','$MAIDEN','$CATCHES','$BOWLINGRUNS')";
    $result_pat=mysqli_query($con,$sql_pat);



?>