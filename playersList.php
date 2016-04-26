<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$TEAM_ID=$_POST['TEAM_ID'];
$RESULT="";
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

	$sql_pat="SELECT FIRST_NAME,LAST_NAME,TP.PLAYER_ID FROM b16_16587264_ipl.`team_players` TP,b16_16587264_ipl.`player_info` PI where TP.PLAYER_ID =PI.PLAYER_ID AND NOW() BETWEEN START_DATE AND END_DATE AND TEAM_ID=$TEAM_ID";
    $result_pat=mysqli_query($con,$sql_pat);

	$RESULT=array();
	$i=0;
while ($row = mysqli_fetch_array($result_pat))
{
$RESULT[$i]=array("name"=>$row[FIRST_NAME]." ".$row[LAST_NAME],"id"=>$row[PLAYER_ID]);
$i++;
//$RESULT=$RESULT."\"id\":\"$row[TEAM_ID]\",\"name\":\"$row[TEAM_NAME]\"},{";
}
//$RESULT=substr($RESULT,0,-2);
	//$RESULT=$RESULT."]}}";
	//echo $RESULT;
	echo json_encode(array(players=>$RESULT));


?>