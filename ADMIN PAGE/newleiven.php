<?php
// input misspelled word
include('connect.php');

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

$shortest = -1;
while($row = $resultQuery->fetch_array())
{
	for($i = 0; $i < $countQuery - 1; $i++) // -1 to skip over primary key id
	{
    //ADD - Query to check if there is a match in the city dictionary (Save time)
    //break

		while($row2 = $resultQuery2->fetch_array())
		{
			for($j = 0; $j < $countQuery2; $j++)
			{
				$lev = levenshtein ($row[$i], $row2[$j]);

        // if not exact match, check to see if it's the shortest so far
        if ($lev <= $shortest || $shortest < 0) {
            // set the closest match, and shortest distance
            $closest  = $row2[$j];
            $shortest = $lev;
        }
			}
		}
		$resultQuery2->data_seek(0);

    if($shortest < 3 && $shortest != 0){
      //Update Table
      $i++; //This gets the id of the patient to update
      $sql = "UPDATE patients
        SET city_suggestion = '$closest'
        WHERE id = $row[$i]";

      if($conn->query($sql) == TRUE)
      {
        echo "UPDATES WORKED";
      }
      else {
        echo "rip";
      }
    }
    $shortest = -1;
	}
}


// Some server-side processsing fun!
$table = 'patients';

// Primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'city',  'dt' => 1 ),
    array( 'db' => 'city_suggestion',   'dt' => 2 )
);

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>Test Leiven</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    //Datatables Resources
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
    <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>

    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <table id="city-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Field in Question</th>
                  <th>Suggestive Fix</th>
              </tr>
          </thead>
  </table>

  <script type="text/javascript" language="javascript" >
    $(document).ready(function() {
        var dataTable = $('#city-grid').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :"city-grid-data.php", // json datasource
                type: "get",  // method  , by default get
                error: function(){  // error handling
                    $(".city-grid-error").html("");
                    $("#city-grid").append('<tbody class="city-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#city-grid_processing").css("display","none");

                }
            }
        } );
    } );
</script>
  </body>
  </html>
