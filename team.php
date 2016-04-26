<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$TEAM_ID=$_POST['TEAM_ID'];
$LEAGUE_ID=$_POST['LEAGUE_ID'];
//$LEAGUE_ID=1;
//$TEAM_ID=1;
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

$sql_pat="SELECT DISTINCT PI.PLAYER_ID,CONCAT(FIRST_NAME,\" \",LAST_NAME) NAME,IFNULL(TOTScore,0) Points FROM b16_16587264_ipl.`team_players` TPI INNER JOIN  b16_16587264_ipl.`player_info` PI  ON TPI.PLAYER_ID=PI.PLAYER_ID LEFT OUTER JOIN (SELECT PS.PLAYER_ID,TP.TEAM_ID,SUM(POINTS_SCORED*TP.POWER_PLAYER) TOTScore FROM b16_16587264_ipl.`team_players` TP,b16_16587264_ipl.`player_score` PS WHERE TP.PLAYER_ID = PS.PLAYER_ID AND PS.PLAYED_DATE BETWEEN TP.START_DATE AND TP.END_DATE AND TP.VALID_IND='Y' and TEAM_ID=$TEAM_ID AND TP.PLAYER_ID IN  (SELECT PLAYER_ID FROM b16_16587264_ipl.`team_players` WHERE POWER_PLAYER=2 AND TEAM_ID=$TEAM_ID AND NOW() between START_DATE AND END_DATE AND VALID_IND='Y') GROUP BY PLAYER_ID,TP.TEAM_ID) TOTAL ON  TOTAL.PLAYER_ID=PI.PLAYER_ID WHERE TPI.TEAM_ID=$TEAM_ID AND TPI.POWER_PLAYER=2 AND NOW() BETWEEN START_DATE AND END_DATE AND LEAGUE_ID=$LEAGUE_ID ORDER BY TOTScore desc";

    $result_pat=mysqli_query($con,$sql_pat);


	 echo "<div id ='myPowercontainer'>";
	
	 $columns=array();
	 $i=0;
$powerId="";
while ($fieldinfo=mysqli_fetch_field($result_pat))
    {	if($fieldinfo->name=='PLAYER_ID'){
	
}else{
$columns[$i]=$fieldinfo->name;
		//echo "<th>{$fieldinfo->name}</th>";
		$i++;
		}
	}
	//echo "</tr>";
while ($row = mysqli_fetch_array($result_pat))
{
	 echo "<div class ='myPower'>";
	 echo "<div class ='myPowerlogo'>";
	 echo "PP";
	 echo "</div>";
    //echo "<tr>";
	$powerId=$row['PLAYER_ID'];

    foreach($columns as $column) {
		if($column=='NAME'){
	echo "<div id=".$row['PLAYER_ID']." onClick='scores(this.id)'>$row[$column]</div>";
}else{
        echo "<div>$row[$column]</div>";
}
   }

   //echo "</tr>";
   echo "<div class='pppts'>";
	echo "pts";
	echo "</div>";
	echo "</div>";

}

//echo "</table>";











	$sql_pat="SELECT DISTINCT PI.PLAYER_ID,CONCAT(FIRST_NAME,\" \",LAST_NAME) NAME,IFNULL(TOTScore,0) Points FROM b16_16587264_ipl.`team_players` TPI INNER JOIN  b16_16587264_ipl.`player_info` PI  ON TPI.PLAYER_ID=PI.PLAYER_ID LEFT OUTER JOIN (SELECT PS.PLAYER_ID,TP.TEAM_ID,SUM(POINTS_SCORED*TP.POWER_PLAYER) TOTScore FROM b16_16587264_ipl.`team_players` TP,b16_16587264_ipl.`player_score` PS WHERE TP.PLAYER_ID = PS.PLAYER_ID AND PS.PLAYED_DATE BETWEEN TP.START_DATE AND TP.END_DATE AND TP.VALID_IND='Y' and TEAM_ID=$TEAM_ID AND TP.PLAYER_ID NOT IN  (SELECT PLAYER_ID FROM b16_16587264_ipl.`team_players` WHERE POWER_PLAYER=2 AND TEAM_ID=$TEAM_ID AND NOW() between START_DATE AND END_DATE AND VALID_IND='Y') GROUP BY PLAYER_ID,TP.TEAM_ID) TOTAL ON  TOTAL.PLAYER_ID=PI.PLAYER_ID  WHERE TPI.TEAM_ID=$TEAM_ID AND TPI.POWER_PLAYER<>2 AND NOW() BETWEEN START_DATE AND END_DATE AND LEAGUE_ID=$LEAGUE_ID ORDER BY TOTScore desc ";
    $result_pat=mysqli_query($con,$sql_pat);


	 //echo "<table id=\"$TEAM_ID\" border='2' >";
	 //echo "<tr>";
	 
	 echo "<div id ='mynormplaycontainer'>";
	 
	 $columns=array();
	 $i=0;
while ($fieldinfo=mysqli_fetch_field($result_pat))
    {	

if($fieldinfo->name=='PLAYER_ID'){
	
}else{
$columns[$i]=$fieldinfo->name;
		//echo "<th>{$fieldinfo->name}</th>";
		$i++;
		}
	}
	//echo "</tr>";
while ($row = mysqli_fetch_array($result_pat))
{
    //echo "<tr>";
	
	echo "<div class ='myPower'>";
	 echo "<div class ='mynormPlaylogo'  >";
	 echo "P";
	 echo "</div>";

    foreach($columns as $column) {
		if($column=='NAME'){
	echo "<div id=".$row['PLAYER_ID']." onClick='scores(this.id)'>$row[$column]</div>";
}else{
        echo "<div>$row[$column]</div>";
}
    }

    //echo "</tr>";
	
	echo "<div class='pppts'>";
	echo "pts";
	echo "</div>";
	echo "</div>";

}

echo "</div>";
echo "<label id=\"powerId\" style=\"visibility:hidden\">$powerId</label>";

?>