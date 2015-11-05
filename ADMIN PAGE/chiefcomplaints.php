<?php
include('connect.php');
$conn = new mysqli($hostname, $username, $password, $database);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Query the chief complaints
$query = "SELECT value FROM femr.chief_complaints";
$resultQuery = $conn->query($query);
$countQuery = mysqli_field_count($conn);
// Split the string into words
while($row = $resultQuery->fetch_array())
{
  for($i = 0; $i < $countQuery; $i++)
  {
    //Split chief complaints into array of words
    $words = preg_split("/[\s,]+/", $row[$i]);
    //Count the array list
    $counts = count($words);
    //Create for loop to go through each words array
    for($j = 0; $j < $counts; $j++)
    {
      //Probably way better way to approach this. Query to find if chief complaint exists.
      $query2 = "SELECT COUNT(value), id, frequency FROM femr.cc_frequency_table WHERE value = '$words[$j]'";
      $resultQuery2 = $conn->query($query2);
      $row2 = $resultQuery2->fetch_array();

      //If it exists, increment frequency counter
      if($row2[0] == 1)
      {
          $varUpdate = $row2[2] + 1;
          $query3 = "UPDATE femr.cc_frequency_table SET frequency='$varUpdate' WHERE id='$row2[1]'";
          $conn->query($query3);

      }//If it doesn't, insert new value and set frequency to 1
      elseif($row2[0] == 0)
      {
          $query3 = "INSERT INTO femr.cc_frequency_table (value, frequency) VALUES ('$words[$j]', '1')";
          $conn->query($query3);

      }
    }
  }
}
?>
