<?php

include('connect.php');

$conn = new mysqli($hostname, $username, $password, $database);

if (isset($_POST['buttonsave'])) {
    $UpdateQuery = "UPDATE patients SET city='$_POST['test']' WHERE id='$_POST['idUnique']'";
   $result = $conn->query($UpdateQuery);
    if($result)
    {
      echo "Update worked";
    }
}
?>
