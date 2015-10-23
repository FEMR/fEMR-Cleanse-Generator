<?php
// input misspelled word
include('connect.php');

$conn = new mysqli($hostname, $username, $password, $database);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Grab the count of the number of cities PATIENTS
$patientCities = "SELECT city FROM femr.patients LIMIT 5";

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
?>   <div class='container'>
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
	for($i = 0; $i < $countQuery; $i++)
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
    // no shortest distance found, yet

    // if ($shortest == 0) {
    //     //echo "Exact match found: $closest\n";
    // } else
  //
  if( $shortest < 3 && $shortest != 0): ?>

         <tr>
           <td> <?php  echo $row[$i]; ?> </td>
           <td> <?php echo $closest; ?> </td>
             <td align='center'><div class='btn-group'>
             <button class='btn btn-danger' type='button'
             onclick='javascript:selectRow(1,2); return false;'>Skip</button>
             <button class='btn btn-success' type='button'
             onclick='javascript:selectRow(this); return false;'>Modify</button>
            <a href="#" data-id="<?php echo $value; ?>" data-city=<?php echo $row[$i+1]; ?>  class="update-row">Update</a>
             </div></td>
         </form>
         </tr>

   <? endif;
    //
    // if($shortest < 3 && $shortest != 0){
    //   echo "<div class='container'>
    // <div class='row col-md-6 col-md-offset-2 custyle'>
    // <table class='table table-striped custab table-bordered'>
    // <thead>
    //     <tr>";
    //   echo "<th> Input Word </th>";
    //   echo "<th> Suggested </th>";
    //   echo "<th> Action </th>";
    //   echo "</tr>
    //     </thead>
    //     <tbody>
    //     <tr>";
    //   echo "<td>". $row[$i] . "</td>";
    //     echo "<td>" . $closest . "</td>";
    //     echo "<td align='center'><div class='btn-group'>
    //     <button class='btn btn-danger' type='button'
    //     onclick='javascript:selectRow(this); return false;'>Skip</button>
    //     <button class='btn btn-success' type='button'
    //     onclick='javascript:selectRow(this); return false;'>Modify</button>
    //     </div></td>";
    //   echo "</tr>
    //         </tbody>
    //   </table>
    //   </div>
    //   </div>";
    //
    // }
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
<script language="javascript">
$('.update-row').click(function (event) {
   event.preventDefault();
   var id = $(this).data('id');
   var city = $(this).data('city');
   $.ajax({
      url: "modify.php",
      method: "POST",
      cache: false,
      data: { id: id , city: city}
   });
});
</script>
  <head>
    <meta charset="utf-8">
    <title>Test Leiven</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </head>
  <body>

  </body>
  </html>
