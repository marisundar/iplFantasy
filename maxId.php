<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 

// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

	$sql_pat="select max(MATCH_ID) maxId FROM b16_16587264_ipl.match_info";
    $result_pat=mysqli_query($con,$sql_pat);

	 while($row_pat = mysqli_fetch_array($result_pat)){
		 echo $row_pat['maxId'];
	}


?>