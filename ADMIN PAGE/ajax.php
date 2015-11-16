<?php

include('connect.php');

$city = $_POST['citySelected'];
$id = $_POST['uniqueID'];

$conn = new mysqli($hostname, $username, $password, $database);

if (isset($_POST['buttonsave']))
{
    $UpdateQuery = "UPDATE patients SET city='$city' WHERE id='$id'";
echo $city;
echo $id;
   $result = $conn->query($UpdateQuery);
    if($result)
    {
      echo "Successful Update";
    }
}
?>
