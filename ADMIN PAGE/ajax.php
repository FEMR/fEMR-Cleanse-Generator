<?php

include('connect.php');

$city = $_POST['citySelected'];
$id = $_POST['uniqueID'];
$other = $_POST['other'];

$conn = new mysqli($hostname, $username, $password, $database);

if (isset($_POST['buttonsave']))
{
	//Prevent SQL Injections
	$stmt = $conn->stmt_init();
	$stmt->prepare('UPDATE patients SET city=? where id=?');
	
	//Update field based on free form field.
  if($city != "Other")
	$stmt->bind_param("ss", $city, $id);
  else
    $stmt->bind_param("ss", $other, $id);
    
    $result = $stmt->execute();
    
    if($result)
    {
      echo "Successful Update";
    }
	else{
		echo "Update Failed";
	}
}
?>
