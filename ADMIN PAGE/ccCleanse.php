<?php
include('connect.php');
$conn = new mysqli($hostname, $username, $password, $database);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Query the chief complaints
$query = "TRUNCATE femr.cc_frequency_table";
$resultQuery = $conn->query($query);

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
//Display the stuff
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>fEMR City Cleanse Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<?php

$per_page = 100;
$pages_query= $conn->query("SELECT * FROM femr.cc_frequency_table");

$row = $pages_query->fetch_assoc();
$row["COUNT('id')"]; //The count!~

$pages = ceil($row["COUNT('id')"] / $per_page);

$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

$start = ($page - 1) * $per_page;

?>  <div class="jumbotron"> <div class='container'>
<center><img align="middle" src="images/femrLogo.png"></center>
<center><h1> City Cleanse Results </h1></center>
 <center><div class='row col-md-6 col-md-offset-2 custyle'></center>

 <table class='table table-striped custab table-bordered'>


 <thead>
     <tr>
       <th> Id </th>
     <th> Value </th>
   <th> Frequency </th>
   </tr>
         </thead>

    <?php

    while($row = $resultQuery->fetch_assoc()) {

    		?>
	         <tr>
						 <!-- THe associated city -->
	           <td align='left' width="40%"> <?php  echo $row["id"]; ?> </td>
             <td align='left' width="40%"> <?php  echo $row["value"]; ?> </td>
             <td align='left' width="40%"> <?php  echo $row["frequency"]; ?> </td>
               <td align='left'><div class='btn-group'></td>
	            </div></td>
	         </tr>
	    <?
      }
      ?>
    </tbody>
    </table>

  <?php
  // Pagination
  $prev = $page -1;
  $next = $page +1;
  echo "<ul class='pagination'>";
  if(!($page<=1)){
    echo "<li><a href='tests.php?page=$prev'>Prev</a></li>";
  }

  if($pages>=1 && $page<=$pages){
    for($x=1;$x<=$pages;$x++){
      echo ($x == $page) ? '<li><strong><a href="?page='.$x.'">'.$x.'</a></strong></li>':'<li><a href="?page='.$x.'">'.$x.'</a></li>';
    }
  }

  if(!($page>=$pages)){
    echo "<li><a href='tests.php?page=$next'>Next</a></li>";
  }
  echo "</ul>";
  ?>
  </div>
</html>
