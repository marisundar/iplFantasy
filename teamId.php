<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$PLAYER_ID=$_POST['PLAYER_ID'];
$RESULT="";
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

	$sql_pat="SELECT TEAM_ID FROM b16_16587264_ipl.`team_players` TP where TP.PLAYER_ID = $PLAYER_ID AND NOW() BETWEEN START_DATE AND END_DATE";
    $result_pat=mysqli_query($con,$sql_pat);
if ($row = mysqli_fetch_array($result_pat))
{
	echo $row['TEAM_ID'];
//$RESULT=$RESULT."\"id\":\"$row[TEAM_ID]\",\"name\":\"$row[TEAM_NAME]\"},{";
}
else{
	echo 0;
}
//$RESULT=substr($RESULT,0,-2);
	//$RESULT=$RESULT."]}}";
	//echo $RESULT;
	



?>