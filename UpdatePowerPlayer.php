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



$sql_pat="INSERT INTO b16_16587264_ipl.powerPlayerChange(`TEAM_ID`, `UPDATE_DATE`)  values ($TEAM_ID,CURDATE())";
$result_pat=mysqli_query($con,$sql_pat) or die("Already changed");


$sql_pat="INSERT INTO b16_16587264_ipl.team_players(`TEAM_ID`, `PLAYER_ID`, `SOLD_AMOUNT`,`END_DATE`, `VALID_IND`, `POWER_PLAYER`)  (SELECT `TEAM_ID`, `PLAYER_ID`, `SOLD_AMOUNT`, \"2017-01-01 00:00:00\", `VALID_IND` ,1 FROM b16_16587264_ipl.team_players WHERE TEAM_ID =$TEAM_ID AND POWER_PLAYER =2 AND NOW() BETWEEN START_DATE AND END_DATE)   ";
$result_pat=mysqli_query($con,$sql_pat);
$sql_pat="UPDATE b16_16587264_ipl.team_players SET END_DATE=NOW() WHERE TEAM_ID =$TEAM_ID AND POWER_PLAYER =2 AND NOW() BETWEEN START_DATE AND END_DATE";
    $result_pat=mysqli_query($con,$sql_pat);
$sql_pat="INSERT INTO b16_16587264_ipl.team_players(`TEAM_ID`, `PLAYER_ID`, `SOLD_AMOUNT`,`END_DATE`, `VALID_IND`, `POWER_PLAYER`)  (SELECT `TEAM_ID`, `PLAYER_ID`, `SOLD_AMOUNT`, \"2017-01-01 00:00:00\", `VALID_IND` ,2 FROM b16_16587264_ipl.team_players WHERE TEAM_ID =$TEAM_ID AND PLAYER_ID=$PLAYER_ID)   ";
$result_pat=mysqli_query($con,$sql_pat);

$sql_pat="UPDATE b16_16587264_ipl.team_players SET END_DATE=NOW() WHERE TEAM_ID =$TEAM_ID AND PLAYER_ID=$PLAYER_ID  AND POWER_PLAYER =1 AND NOW() BETWEEN START_DATE AND END_DATE";
    $result_pat=mysqli_query($con,$sql_pat);


?>










	$sql_pat="SELECT FIRST_NAME,LAST_NAME,TOTScore FROM (SELECT PS.PLAYER_ID,TP.TEAM_ID,SUM(POINTS_SCORED*TP.POWER_PLAYER) TOTScore FROM b16_16587264_ipl.`team_players` TP,b16_16587264_ipl.`player_score` PS WHERE TP.PLAYER_ID = PS.PLAYER_ID AND PS.PLAYED_DATE BETWEEN TP.START_DATE AND TP.END_DATE AND TP.VALID_IND='Y' and TEAM_ID=2 AND TP.PLAYER_ID NOT IN  (SELECT PLAYER_ID FROM b16_16587264_ipl.`team_players` WHERE POWER_PLAYER=2 AND TEAM_ID=2 AND NOW() between START_DATE AND END_DATE AND VALID_IND='Y') GROUP BY PLAYER_ID,TP.TEAM_ID) TOTAL,b16_16587264_ipl.`player_info` PI where TOTAL.PLAYER_ID=PI.PLAYER_ID GROUP BY PI.PLAYER_ID ORDER BY TEAM_ID desc ";
    $result_pat=mysqli_query($con,$sql_pat);


	 echo "<table id=\"$TEAM_ID\" border='2' >";
	 echo "<tr>";
	 $columns=array();
	 $i=0;
while ($fieldinfo=mysqli_fetch_field($result_pat))
    {	$columns[$i]=$fieldinfo->name;
		echo "<th>{$fieldinfo->name}</th>";
		$i++;
	}
	echo "</tr>";
while ($row = mysqli_fetch_array($result_pat))
{
    echo "<tr>";

    foreach($columns as $column) {
        echo "<td>$row[$column]</td>";
    }

    echo "</tr>";

}

echo "</table>";


?>