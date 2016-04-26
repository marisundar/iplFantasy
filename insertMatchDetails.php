<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$MATCH_ID=$_POST['MATCH_ID'];
$PLAYED_DATE=$_POST['PLAYED_DATE'];
$MATCH_INFO=$_POST['MATCH_INFO'];
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 
$sql_pat="delete from `b16_16587264_ipl`.match_info where MATCH_ID='$MATCH_ID'";
    $result_pat=mysqli_query($con,$sql_pat);
	$sql_pat="insert into `b16_16587264_ipl`.match_info(MATCH_ID,PLAYED_DATE,MATCH_INFO) values('$MATCH_ID','$PLAYED_DATE','$MATCH_INFO')";
    $result_pat=mysqli_query($con,$sql_pat);



?>