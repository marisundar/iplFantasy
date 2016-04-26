<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 

// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

	$sql_pat="SELECT FIRST_NAME,LAST_NAME, SUM(`NO_OF_WICKETS`) TOT_wICKETS, SUM(`NO_OF_OVERS`) TOT_OVERS, SUM(`NO_OF_RUNOUTS`)TOT_RUNOUTS, SUM(`NO_OF_STUMPING`) TOT_STUMPING, SUM(`NO_OF_MAIDEN`) TOT_MAIDEN, SUM(`NO_OF_CATCHES`) TOT_CATCHES FROM b16_16587264_ipl.`player_fielding_info` pfi,b16_16587264_ipl.player_info pi where pfi.PLAYER_ID=pi.PLAYER_ID group by pfi.PLAYER_ID order by TOT_wICKETS DESC,TOT_CATCHES DESC, TOT_wICKETS DESC";
    $result_pat=mysqli_query($con,$sql_pat);

	 echo "</br></br>";
	 echo "<table border='1'>";
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