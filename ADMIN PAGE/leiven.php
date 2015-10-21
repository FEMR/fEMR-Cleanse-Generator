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
    if($shortest < 3 && $shortest != 0){
      echo "<div class='container'>
    <div class='row col-md-6 col-md-offset-2 custyle'>
    <table class='table table-striped custab table-bordered'>
    <thead>
        <tr>";
      echo "<th> Input Word </th>";
      echo "<th> Suggested </th>";
      echo "<th> Action </th>";
      echo "</tr>
        </thead>
        <tbody>
        <tr>";
      echo "<td>". $row[$i] . "</td>";
        echo "<td>" . $closest . "</td>";
        echo "<td align='center'><div class='btn-group'>
        <button class='btn btn-danger' type='button'
        onclick='javascript:selectRow(this); return false;'>Skip</button>
        <button class='btn btn-success' type='button'
        onclick='javascript:selectRow(this); return false;'>Modify</button>
        </div></td>";
      echo "</tr>
            </tbody>
      </table>
      </div>
      </div>";

    }
    $shortest = -1;
	}
}
 // for($i = 0; $i < $countQuery;$i++){
            // for($j = 0; $j < $countQuery2; $j++){

// echo "$i";
   // while($row = $resultQuery->fetch_array())
   // {
	   // $j = 0;
		// while($row2 = $resultQuery2->fetch_array())
		// {
                // $lev = levenshtein($row[i], $row2[j]);
                    // echo $lev;
                 // // check for an exact match
                 // if ($lev == 0) {

                // // closest word is this one (exact match)
                // $closest = $row[j];
                // $shortest = 0;

                // // break out of the loop; we've found an exact match
                // break;
                // }

                // if ($lev <= $shortest || $shortest < 0) {
                    // //// set the closest match, and shortest distance
                    // $closest  = $row[j];
                    // $shortest = $lev;
                // }
				// $j++;
            // }
			// $i++;
		// $resultQuery2->data_seek(0);
                // echo "Input word: $row[$i]\n";
                // if ($shortest == 0) {
                    // echo "Exact match found: $row[$i]\n";
                // } else {
                    // echo "Did you mean: $closest?\n";
                // }
     // }

//
// //find the shortest leiventhan distance, and store that
// $input = 'detriot';
//
// // array of words to check against
// $words  = array('apple','pineapple','banana','orange',
//                 'radish','carrot','pea','bean','potato', 'detroit');
//
// // no shortest distance found, yet
// $shortest = -1;
//
// // loop through words to find the closest
// foreach ($words as $word) {
//
//     // calculate the distance between the input word,
//     // and the current word
//     $lev = levenshtein($input, $word);
//
//     // check for an exact match
//     if ($lev == 0) {
//
//         // closest word is this one (exact match)
//         $closest = $word;
//         $shortest = 0;
//
//         // break out of the loop; we've found an exact match
//         break;
//     }
//     echo $lev;
//     // if this distance is less than the next found shortest
//     // distance, OR if a next shortest word has not yet been found
//     if ($lev <= $shortest || $shortest < 0) {
//         // set the closest match, and shortest distance
//         $closest  = $word;
//         $shortest = $lev;
//     }
// }
//
// echo "Input word: $input\n";
// if ($shortest == 0) {
//     echo "Exact match found: $closest\n";
// } else {
//     echo "Did you mean: $closest?\n";
// }

?>

<!DOCTYPE html>
<html>

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
