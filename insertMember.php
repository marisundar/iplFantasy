<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$team=$_POST['team'];
$email=$_POST['email'];
$password=$_POST['password'];
// Connect to server and select databse.


$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

$sql_pat="INSERT INTO b16_16587264_ipl.`team_members`(`TEAM_ID`, `FIRST_NAME`, `LAST_NAME`, `EMAIL_ID`, `PASSWORD`) VALUES ('$team','$fname','$lname','$email','$password')";
//echo $sql_pat;
    $result_pat=mysqli_query($con,$sql_pat);
	

    header("Location: http://marisundar.byethost16.com/");


?>