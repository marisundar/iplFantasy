
<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$TEAM_ID=$_POST['TEAM_ID'];

//$TEAM_ID=5;
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

$sql_pat="SELECT DISTINCT TPI.PLAYER_ID,CONCAT(FIRST_NAME,\" \",LAST_NAME) NAME,SOLD_AMOUNT,AVAILABLE_FOR_AUCTION FROM b16_16587264_ipl.`team_players` TPI ,b16_16587264_ipl.`player_info` PI WHERE PI.PLAYER_ID=TPI.PLAYER_ID AND TPI.TEAM_ID=$TEAM_ID AND NOW() BETWEEN START_DATE AND END_DATE ";

    $result_pat=mysqli_query($con,$sql_pat);


	 echo "<table id = 'retain-palyers'>";
	 // Mari, No need of Headers
	//echo "<tr>";
	 $columns=array();
	 $i=0;
$powerId="";
while ($fieldinfo=mysqli_fetch_field($result_pat))
    {	if($fieldinfo->name=='PLAYER_ID'){
		//echo "<th> </th>";
		}else{
			
		//echo "<th>{$fieldinfo->name}</th>";
		
		}
		$columns[$i]=$fieldinfo->name;
		$i++;
	}
	//karan
	//echo "<th> Price </th>";
	//echo "</tr>";
while ($row = mysqli_fetch_array($result_pat))
{
	 //echo "</div>";
    echo "<tr>";
	$powerId=$row['PLAYER_ID'];

    foreach($columns as $column) {
		if($column=='PLAYER_ID'){
			
				if($row['AVAILABLE_FOR_AUCTION']!=8){
				echo "<td><input type='checkbox' id=".$row['PLAYER_ID']." name='reatinedPlayer' onclick='checkFor5(this)' disabled></td>";
				}
				else{echo "<td><input type='checkbox' id=".$row['PLAYER_ID']." name='reatinedPlayer' onclick='checkFor5(this)' ></td>";
				}
			}else{
				
				if($column!='AVAILABLE_FOR_AUCTION' && $column!='SOLD_AMOUNT'){
				
					echo "<td name=".$row['PLAYER_ID'].">$row[$column]</td>";
				}
				
				if($column=='SOLD_AMOUNT'){
				
					echo "<td class ='price'> ".$row['SOLD_AMOUNT']." </td>";
				}
			}
			//Mari add price Here, class = 'price' is must
   }
//Mari delete this after you add price
//echo "<td class ='price'> ".$row['SOLD_AMOUNT']." </td>";
   echo "</tr>";

}

echo "</table>";







?>