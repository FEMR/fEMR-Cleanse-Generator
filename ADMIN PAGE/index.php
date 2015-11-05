<!DOCTYPE html>
<html>
<body>
<div class="navigation">
    <div class="container">

        <div class="navigationLogo">
  <a href="/">
      <img src="FEMR LOGO ADMIN PAGE.png" />
  </a>

</div>

    </div>
</div>
<br>
  </body>

</html>
<?php

include('connect.php');

$conn = new mysqli($hostname, $username, $password, $database);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Grab the count of the number of cities PATIENTS
//SELECT city, id FROM femr.patients WHERE city NOT IN (SELECT name FROM mission_cities)
//SELECT city, id FROM femr.patients LIMIT 5
$patientCities = "SELECT city, id FROM femr.patients LIMIT 5";

$resultQuery = $conn->query($patientCities);
$countQuery = mysqli_field_count($conn);
// while($row = $resultQuery->fetch_array()){
    // for($i = 0; $i < $countQuery;$i++)
        // echo $row[$i];
// }

//Grabbing the count of the cities DICTIONARY
$cityDictionary = "SELECT name FROM femr.mission_cities";
$resultQuery2 = $conn->query($cityDictionary);
$countQuery2 = mysqli_field_count($conn);
// while($row2 = $resultQuery2->fetch_array()){
    // for($j = 0; $j < $countQuery2;$j++)
        // echo $row[$j];
// }
?>  <div class="jumbotron"> <div class='container'>
<center><img align="middle" src="images/femrLogo.png"></img></center>
<center><h1> City Cleanse Results </h1></center>
 <center><div class='row col-md-6 col-md-offset-2 custyle'></center>

 <table class='table table-striped custab table-bordered'>


 <thead>
     <tr>
       <th> Input Word </th>
     <th> Suggested </th>
   <th> Action </th>
   </tr>
         </thead>

         <?php
$shortest = -1;
while($row = $resultQuery->fetch_array())
{
	for($i = 0; $i < $countQuery - 1; $i++)
	{
		while($row2 = $resultQuery2->fetch_array())
		{
			for($j = 0; $j < $countQuery2; $j++)
			{
				$lev = levenshtein ($row[$i], $row2[$j]);

				// check for an exact match
				if($lev == 0)
				{
					//closest word is this one
					$closest = $row2[$j];
					$shortest = 0;

					//break out, found exact match
					break;
				}

        // if not exact match, check to see if it's the shortest so far
        if ($lev <= $shortest || $shortest < 0) {
            // set the closest match, and shortest distance
            $closest  = $row2[$j];
            $shortest = $lev;
        }
			}
		}
		$resultQuery2->data_seek(0);
  if( $shortest < 3 && $shortest != 0): ?>

         <tr>
           <td align='left' width="40%"> <?php  echo $row[$i]; ?> </td>

            <td align='left'><div class='btn-group'>
            <form  action='index.php' method='POST'>
                <input type="hidden" name="id" value="<?php echo $row[$i+1]; ?>">
                <input type="text" name="suggestivecity" value="<?php echo $closest ?>">
                <td align='center' width="5%"><button type="submit" name="update" value="update" class="btn btn-success">Update</button>
                <!-- <button type="submit" name="newfield" value="newfield" class="btn btn-success">SuggestNew</button> -->
            </form>
            </div></td>
         </tr>
   <? endif;
    $shortest = -1;
	}
}?>





</tbody>
</table>
</div>
</div><?php

?>

<!DOCTYPE html>
<html>

<?php
  if (isset($_POST['update']))
  {
    $UpdateQuery = "UPDATE patients SET city='$_POST[suggestivecity]' WHERE id='$_POST[id]'";
    $conn->query($UpdateQuery);
  };
  // if (isset($_POST['newField']))
  // {
  //   $UpdateQuery = "UPDATE patients SET city='$_POST[suggestivecity]' WHERE id='$_POST[id]'";
  //   $conn->query($UpdateQuery);
  // };
?>

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



  </html>
