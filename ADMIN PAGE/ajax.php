<?php

include('connect.php');

$city = $_POST['citySelected'];
$id = $_POST['uniqueID'];
$other = $_POST['other'];

$conn = new mysqli($hostname, $username, $password, $database);

if (isset($_POST['buttonsave']))
{
  if($city != "Other")
    $UpdateQuery = "UPDATE patients SET city='$city' WHERE id='$id'";
  else 
    $UpdateQuery = "UPDATE patients SET city='$other' WHERE id='$id'";

   $result = $conn->query($UpdateQuery);
    if($result)
    {
      echo "Successful Update";
    }
}
?>
