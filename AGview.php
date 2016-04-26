<?php

//Inclue database configuration
//require_once('connections.php');
// $hostname = "localhost";
//$database = "b16_16587264_arun";
//$username = "b16_16587264";
//$password = "vaira1129"; //password not required for wamp, so put this $password = "";

//$conn = mysql_connect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 

// Select a database
//mysql_select_db($database) or die ('Cannot connect to the database: ' . mysql_error());

?>
                               
<?php

 $hostname = "sql213.byethost16.com";
//$hostname ="185.27.134.10";
$database = "b16_16587264_arun";
$username = "b16_16587264";
$password = "vaira1129"; //password not required for wamp, so put this $password = "";

$conn = mysql_connect($hostname, $username, $password,$database) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database) or die ('Cannot connect to the database: ' . mysql_error());
$pres=$_GET['pressure'];

print "insert into arun(pressure) values('".$pres."')".$conn;

//print "over"

$sql="insert into arun(pressure) values('".$pres."')";

print "start------------".$query1;
//$query1 = $conn->query($sql);
//mysql_query($sql);
print "over------------".$query1;

    echo "New record created successfully";

    echo "Error: " . $sql . "<br>" . $conn->error;


print "over".$query1;





print('<table border="1">');
print( "<th>pressure</th>");




$query1 = mysql_query("
SELECT arun.pressure
FROM arun ");

	// Fetch tha data from the database 
	while ($row = mysql_fetch_array($query1)) 
	{print("<tr>");
		//Display the Results
		print( "<td>");
		 echo $row['pressure'];
		 print( "</td>");
		 
		
print "</tr>";
	}
	print("</table>");

?>
