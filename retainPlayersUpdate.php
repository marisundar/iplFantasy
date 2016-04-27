
<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$resultVal=$_POST['resultVal'];
//echo $resultVal;
//$TEAM_ID=5;

$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 



$array = json_decode($resultVal,true);

//echo "team is".$array['teamid']."</br>";
$TEAM_ID=$array['teamid'];
$sql_pat="INSERT INTO b16_16587264_ipl.retainPlayersUpdate(`TEAM_ID`, `UPDATE_DTM`,`CURRENT_DATE`)  values ($TEAM_ID,NOW(),NOW())";
//echo $sql_pat;
$result_pat=mysqli_query($con,$sql_pat) or die("Already changed");
echo "<table BORDER=\"2\">";
foreach($array['PLAYERS'] as $player) { //foreach element in $arr
    //echo $player['PLAYER_ID']; 
	$PLAYER_ID=$player['PLAYER_ID'];
	$sql_patern="SELECT DISTINCT CONCAT(FIRST_NAME,\" \",LAST_NAME) NAME,SOLD_AMOUNT,AVAILABLE_FOR_AUCTION FROM b16_16587264_ipl.`team_players` TPI ,b16_16587264_ipl.`player_info` PI WHERE PI.PLAYER_ID=TPI.PLAYER_ID AND TPI.TEAM_ID=$TEAM_ID AND TPI.PLAYER_ID=$PLAYER_ID  AND NOW() BETWEEN START_DATE AND END_DATE ";
//echo $sql_patern;
    $result_pattern=mysqli_query($con,$sql_patern);
	echo "<tr>";
	$count=1;
while ($row = mysqli_fetch_array($result_pattern))
{
	
	echo "<td>$count</td>";
	$count=$count+1;
	echo "<td>".$row['NAME']."</td>";
}
	echo "</tr>";
	$sql_pat="UPDATE b16_16587264_ipl.`team_players` SET AVAILABLE_FOR_AUCTION=2,END_DATE='2016-04-29 23:59:59' where TEAM_ID=$TEAM_ID AND PLAYER_ID=$PLAYER_ID AND NOW() BETWEEN START_DATE AND END_DATE ";
	
	$result_pat=mysqli_query($con,$sql_pat);
	//echo "</br>";
	
}
echo "</table>";
echo "<button onclick='window.location.href=\"http://marisundar.byethost16.com/\"'>Continue</button>";


?>