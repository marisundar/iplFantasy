<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$name=$_POST['Name'];
//$name='Sachin';
//$TEAM_ID=1;
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

$sql_pat="SELECT DISTINCT PI.PLAYER_ID,CONCAT(FIRST_NAME,\" \",LAST_NAME) NAME FROM b16_16587264_ipl.`player_info` PI WHERE CONCAT(FIRST_NAME,\" \",LAST_NAME) LIKE '%$name%' ";

    $result_pat=mysqli_query($con,$sql_pat);


	 echo "<table border=\"2\">";
	echo "<tr>";
	 $columns=array();
	 $i=0;
$powerId="";
while ($fieldinfo=mysqli_fetch_field($result_pat))
    {	if($fieldinfo->name=='PLAYER_ID'){
		echo "<th> </th>";
		}else{
			
		echo "<th>{$fieldinfo->name}</th>";
		
		}
		$columns[$i]=$fieldinfo->name;
		$i++;
	}
	echo "</tr>";
while ($row = mysqli_fetch_array($result_pat))
{
	 //echo "</div>";
    echo "<tr>";
	$powerId=$row['PLAYER_ID'];

    foreach($columns as $column) {
		if($column=='PLAYER_ID'){
	echo "<td><button id=".$row['PLAYER_ID']." onClick='addPlayer(this.id)'>+</button></td>";
			}else{
        echo "<td name=".$row['PLAYER_ID'].">$row[$column]</td>";
			}
   }

   echo "</tr>";

}

echo "</table>";







?>