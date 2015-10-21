<?php
#Include the connect.php file
include('connect.php');
// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Get data and store
$from = 0;
$to = $5;
$query = "SELECT city FROM patients LIMIT ?";
$result = $conn->prepare($query);
$result->bind_param('ii', $from, $to);
$result->execute();

$result->bind_result($city);
while ($result->fetch())
	{
	$customers[] = array(
		'city' => $city
        	);
	}
/* close statement */
$result->close();
/* close connection */
$mysqli->close();
?>




