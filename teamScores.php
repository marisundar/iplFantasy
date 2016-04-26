<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 

// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

	$sql_pat="SELECT TEAM_NAME,IFNULL(TOTScore,0) TOTScore FROM (SELECT TP.TEAM_ID,SUM(POINTS_SCORED*TP.POWER_PLAYER) TOTScore FROM b16_16587264_ipl.`team_players` TP,b16_16587264_ipl.`player_score` PS WHERE TP.PLAYER_ID = PS.PLAYER_ID AND PS.PLAYED_DATE BETWEEN TP.START_DATE AND TP.END_DATE AND TP.VALID_IND='Y'  GROUP BY TP.TEAM_ID) TOTAL RIGHT OUTER JOIN b16_16587264_ipl.`teams` PI on TOTAL.TEAM_ID=PI.TEAM_ID  GROUP BY PI.TEAM_ID ORDER BY TOTScore desc ";
    $result_pat=mysqli_query($con,$sql_pat);

	 echo "</br></br>";
	 echo "<table border='2'>";
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
echo "</br></br>";


?>