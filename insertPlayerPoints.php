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
$ISOUT=$_POST['ISOUT'];
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

$sql_pat="select RUNSFACTOR  FROM b16_16587264_ipl.player_info_info";
$runFactor=1;
    $result_pat=mysqli_query($con,$sql_pat);

	 while($row_pat = mysqli_fetch_array($result_pat)){
		 $runFactor=$row_pat['RUNSFACTOR'];
	}

$BatPoints=($RUNS*$runFactor)+($FOUR*2*$runFactor)+($SIX*3*$runFactor);
if($RUNS>=25){
$BatPoints=$BatPoints+($RUNS/25)*10;	
}
if($ISOUT=='YES' && $RUNS==0){
$BatPoints=$BatPoints-10;
}
$BatPoints=$BatPoints+($RUNS-$BATSMANBALLS)*2;


$BowlPoints=$WICKETS*20;
$BowlPoints=$BowlPoints+$MAIDEN*25;
$BowlPoints=$BowlPoints+(($OVERS*6*2.5)-$BOWLINGRUNS);


$FieldPoints=$CATCHES*10;
$FieldPoints=$FieldPoints+($STUMPING*15);
$FieldPoints=$FieldPoints+($RUNOUT*10);
$sql_pat="delete from `b16_16587264_ipl`.player_score where MATCH_ID='$MATCH_ID' AND PLAYER_ID='$PLAYER_ID'";
    $result_pat=mysqli_query($con,$sql_pat);
	
	
	$sql_pat="insert into `b16_16587264_ipl`.player_score(`PLAYER_ID`, `MATCH_ID`, `PLAYED_DATE`, `POINTS_SCORED`, `SCORE_TYPE`, `CATEGORY`) values('$PLAYER_ID','$MATCH_ID','$PLAYED_DATE','$BatPoints','BAT','BAT')";
    $result_pat=mysqli_query($con,$sql_pat);
	
	$sql_pat="insert into `b16_16587264_ipl`.player_score(`PLAYER_ID`, `MATCH_ID`, `PLAYED_DATE`, `POINTS_SCORED`, `SCORE_TYPE`, `CATEGORY`) values('$PLAYER_ID','$MATCH_ID','$PLAYED_DATE','$BowlPoints','BOW','BOW')";
    $result_pat=mysqli_query($con,$sql_pat);
	
	$sql_pat="insert into `b16_16587264_ipl`.player_score(`PLAYER_ID`, `MATCH_ID`, `PLAYED_DATE`, `POINTS_SCORED`, `SCORE_TYPE`, `CATEGORY`) values('$PLAYER_ID','$MATCH_ID','$PLAYED_DATE','$FieldPoints','FIE','FIE')";
    $result_pat=mysqli_query($con,$sql_pat);


?>