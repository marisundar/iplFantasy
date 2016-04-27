<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$TEAM_ID=$_POST['TEAM_ID'];
//$TEAM_ID=2;
$RESULT="";
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 
$BOOL="FALSE";
	$sql_pat="SELECT TEAM_ID FROM b16_16587264_ipl.`retainPlayersUpdate`  where TEAM_ID=$TEAM_ID";
	//echo $sql_pat;
    $result_pat=mysqli_query($con,$sql_pat);


	$i=0;
while ($row = mysqli_fetch_array($result_pat))
{
	$BOOL="TRUE";
}
//$RESULT=substr($RESULT,0,-2);
	//$RESULT=$RESULT."]}}";
	//echo $RESULT;
echo $BOOL;

?>