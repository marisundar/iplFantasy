<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 

// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

	$sql_pat="select tot.*,SUM(POINTS_SCORED) TOTpOINTS FROM (SELECT pi.PLAYER_ID,`FIRST_NAME`,`LAST_NAME`,SUM(`NO_OF_SIX`) SIX,SUM(`NO_OF_FOUR`) FOURS,SUM(`TOTAL_RUNS`) TOT_Runs FROM b16_16587264_ipl.`player_batting_info` pbi , b16_16587264_ipl.player_info pi WHERE pbi.PLAYER_ID = pi.PLAYER_ID GROUP BY pbi.PLAYER_ID having TOT_Runs >0) tot,b16_16587264_ipl.player_score ps where tot.PLAYER_ID=ps.PLAYER_ID GROUP BY ps.PLAYER_ID ORDER BY TOTpOINTS desc ";
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