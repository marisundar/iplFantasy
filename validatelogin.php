<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="teleimmersion"; // Database name 
$tbl_name="login"; // Table name 
$EMAIL_ID=$_POST['email'];
$PASSWORD=$_POST['password'];


// Connect to server and select databse.
$con=mysqli_connect("sql213.byethost16.com","b16_16587264","vaira1129")or die("cannot connect"); 

	$sql_pat="select EMAIL_ID,TEAM_ID FROM b16_16587264_ipl.team_members WHERE EMAIL_ID='$EMAIL_ID' AND PASSWORD='$PASSWORD'";
    $result_pat=mysqli_query($con,$sql_pat);

	 if($row_pat = mysqli_fetch_array($result_pat)){
		 if($row_pat['EMAIL_ID']==$EMAIL_ID){
			 echo "success ".$row_pat['TEAM_ID'];
		 }
		 else{
			 echo "invalid password";
		 }
	}
	else{
			 echo "invalid password";
		 }


?>