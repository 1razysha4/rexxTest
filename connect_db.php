<?php
echo "helo";


/*$servername = "localhost";
$username = "";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

*/


// Open Connection
$con = @mysqli_connect('localhost', 'root', '', 'sample_test');

if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}



 


// Some Query
$sql 	= 'SELECT * FROM customer';
$query 	= mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query))
{
	echo $row['gender'];
}

// Close connection
mysqli_close ($con);


