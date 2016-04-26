<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$PLAYER_ID=$_POST['PLAYER_ID'];
//$PLAYER_ID=3993;
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 
//SELECT PS.NO_OF_SIX 6s,PS.NO_OF_FOUR 4s,PS.TOTAL_RUNS R,case when TP.POWER_PLAYER=1 then 'P' ELSE 'PP' END PP,NO_OF_WICKETS W,NO_OF_OVERS O,NO_OF_RUNOUTS+NO_OF_STUMPING+NO_OF_CATCHES F,NO_OF_MAIDEN M FROM b16_16587264_ipl.`team_players` TP, b16_16587264_ipl.`player_batting_info` PS,b16_16587264_ipl.`player_fielding_info` PF WHERE TP.PLAYER_ID = PS.PLAYER_ID AND PS.PLAYED_DATE BETWEEN TP.START_DATE AND TP.END_DATE AND TP.VALID_IND =  'Y' AND PF.PLAYER_ID = TP.PLAYER_ID AND PF.MATCH_ID = PS.MATCH_ID AND TP.PLAYER_ID =3993

//SELECT PS.TOTAL_RUNS R,case when TP.POWER_PLAYER=1 then 'P' ELSE 'PP' END PP,PS.NO_OF_SIX 6s,PS.NO_OF_FOUR 4s,NO_OF_OVERS O,NO_OF_WICKETS W,NO_OF_RUNOUTS RO,NO_OF_STUMPING ST,NO_OF_CATCHES C,NO_OF_MAIDEN M, (select SUM(POINTS_SCORED) FROM b16_16587264_ipl.`player_score` INS where INS.PLAYER_ID=TP.PLAYER_ID AND INS.MATCH_ID = PS.MATCH_ID GROUP BY PLAYER_ID)*TP.POWER_PLAYER Tot FROM b16_16587264_ipl.`team_players` TP, b16_16587264_ipl.`player_batting_info` PS,b16_16587264_ipl.`player_fielding_info` PF WHERE TP.PLAYER_ID = PS.PLAYER_ID AND PS.PLAYED_DATE BETWEEN TP.START_DATE AND TP.END_DATE AND TP.VALID_IND =  'Y' AND PF.PLAYER_ID = TP.PLAYER_ID AND PF.MATCH_ID = PS.MATCH_ID AND TP.PLAYER_ID = 3993

	$sql_pat="SELECT case when TP.POWER_PLAYER=1 then 'P' ELSE 'PP' END PP,PS.TOTAL_RUNS R,PS.NO_OF_SIX 6s,PS.NO_OF_FOUR 4s,NO_OF_OVERS O,NO_OF_WICKETS W,NO_OF_RUNOUTS RO,NO_OF_STUMPING ST,NO_OF_CATCHES C,NO_OF_MAIDEN M, (select SUM(POINTS_SCORED) FROM b16_16587264_ipl.`player_score` INS where INS.PLAYER_ID=TP.PLAYER_ID AND INS.MATCH_ID = PS.MATCH_ID GROUP BY PLAYER_ID)*TP.POWER_PLAYER Tot FROM b16_16587264_ipl.`team_players` TP, b16_16587264_ipl.`player_batting_info` PS,b16_16587264_ipl.`player_fielding_info` PF WHERE TP.PLAYER_ID = PS.PLAYER_ID AND PS.PLAYED_DATE BETWEEN TP.START_DATE AND TP.END_DATE AND TP.VALID_IND =  'Y' AND PF.PLAYER_ID = TP.PLAYER_ID AND PF.MATCH_ID = PS.MATCH_ID AND TP.PLAYER_ID =  $PLAYER_ID ORDER BY PS.PLAYED_DATE";
    $result_pat=mysqli_query($con,$sql_pat);


	 echo "<table id=\"$TEAM_ID\" border='2' >";
	 echo "<tr>";
	 
	 echo "<th>SNO</th>";
	 $columns=array();
	 $i=0;
while ($fieldinfo=mysqli_fetch_field($result_pat))
    {	

if($fieldinfo->name=='PLAYER_ID'){
	
}else{
$columns[$i]=$fieldinfo->name;
		echo "<th>{$fieldinfo->name}</th>";
		$i++;
		}
	}
	echo "</tr>";
	$MatchStart=1;
while ($row = mysqli_fetch_array($result_pat))
{
    echo "<tr>";
	echo "<td>$MatchStart</td>";
	$MatchStart=$MatchStart+1;
    foreach($columns as $column) {
        echo "<td>$row[$column]</td>";
    }

    echo "</tr>";
	
}

echo "</table>";






?>