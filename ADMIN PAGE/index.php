<?php
// input misspelled word
include('connect.php');
// <td><form action='detailform.php' method='POST'>
// <input type='hidden' name='tempId' value='".$row["pId"]."'/>
// <input type='submit' name='submit-btn' value='View/Update Details' />
// <form></td>
$conn = new mysqli($hostname, $username, $password, $database);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Grab the count of the number of cities PATIENTS
$patientCities = "SELECT city, id FROM femr.patients LIMIT 5";

$resultQuery = $conn->query($patientCities);
$countQuery = mysqli_field_count($conn);
// while($row = $resultQuery->fetch_array()){
    // for($i = 0; $i < $countQuery;$i++)
        // echo $row[$i];
// }

//Grabbing the count of the cities DICTIONARY
$cityDictionary = "SELECT city_name FROM femr.citytest";
$resultQuery2 = $conn->query($cityDictionary);
$countQuery2 = mysqli_field_count($conn);
// while($row2 = $resultQuery2->fetch_array()){
    // for($j = 0; $j < $countQuery2;$j++)
        // echo $row[$j];
// }
?>  <div class="jumbotron"> <div class='container'>
 <div class='row col-md-6 col-md-offset-2 custyle'>
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
           <td> <?php  echo $row[$i]; ?> </td>
           <td> <?php echo $closest; ?> </td>
             <td align='center'><div class='btn-group'>
            <form  action='index.php' method='POST'>
                <input type="hidden" name="id" value="<?php echo $row[$i+1]; ?>">
                <input type="hidden" name="suggestivecity" value="<?php echo $closest ?>">
                <button type="submit" name="update" value="update" class="btn btn-success">Update</button>
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
  <title>fEMR Cleanse Generator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="css/bootstrap.css" rel="stylesheet">
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="adminpage.css">
</head>
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand left" href="adminpage.html">fEMR</a>
        </div>
      </div>
</nav>


</div>

  </body>

  <footer>
      <div class="row-fluid">
          <div class="col-xs-6">
                          <img align="middle" src="images/femrLogo.png"></img>
          </div>
          <div class="col-xs-6">
              <p class="text-right">Designed for use in Google Chrome</p>
          </div>
      </div>
  </footer>
  </html>
