<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$query = $_POST['query'];
// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect");

	$sql_pat=$query;
    $result_pat=mysqli_query($con,$sql_pat);
while ($row = mysqli_fetch_array($result_pat))
{

    foreach($row as $value)
    {
        echo $value;
    }



}
?>