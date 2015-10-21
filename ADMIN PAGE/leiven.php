<?php
// input misspelled word
include('connect.php');

$conn = new mysqli($hostname, $username, $password, $database);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
echo "connected successfully";

//Grab the count of the number of cities PATIENTS
$patientCities = "SELECT city FROM femr.patients";

$resultQuery = $conn->query($patientCities);
$countQuery = mysqli_field_count($conn);

// while($row = $resultQuery->fetch_array()){
//     for($i = 0; $i < $countQuery;$i++)
//         echo $row[$i];
// }

//Grabbing the count of the cities DICTIONARY
$cityDictionary = "SELECT city_name FROM femr.citytest";
$resultQuery2 = $conn->query($cityDictionary);
$countQuery2 = mysqli_field_count($conn);
// while($row2 = $resultQuery2->fetch_array()){
//     for($j = 0; $j < $countQuery2;$j++)
//         echo $row[$j];
// }



while($row = $resultQuery->fetch_array()){
    for($i = 0; $i < $countQuery;$i++){
        while($row2 = $resultQuery2->fetch_array()){
            for($j = 0; $j < $countQuery2; $j++){
                $lev = levenshtein($row[i], $row2[j]);
                    echo $lev;
                 // check for an exact match
                 if ($lev == 0) {

                // closest word is this one (exact match)
                $closest = $row[j];
                $shortest = 0;

                // break out of the loop; we've found an exact match
                break;
                }

                if ($lev <= $shortest || $shortest < 0) {
                    //// set the closest match, and shortest distance
                    $closest  = $row[j];
                    $shortest = $lev;
                }
            }
        }
                echo "Input word: $row[i]\n";
                if ($shortest == 0) {
                    echo "Exact match found: $row[i]\n";
                } else {
                    echo "Did you mean: $closest?\n";
                }
    }

}
//find the shortest leiventhan distance, and store that
$input = 'detriot';

// array of words to check against
$words  = array('apple','pineapple','banana','orange',
                'radish','carrot','pea','bean','potato', 'detroit');

// no shortest distance found, yet
$shortest = -1;

// loop through words to find the closest
foreach ($words as $word) {

    // calculate the distance between the input word,
    // and the current word
    $lev = levenshtein($input, $word);

    // check for an exact match
    if ($lev == 0) {

        // closest word is this one (exact match)
        $closest = $word;
        $shortest = 0;

        // break out of the loop; we've found an exact match
        break;
    }
    echo $lev;
    // if this distance is less than the next found shortest
    // distance, OR if a next shortest word has not yet been found
    if ($lev <= $shortest || $shortest < 0) {
        // set the closest match, and shortest distance
        $closest  = $word;
        $shortest = $lev;
    }
}

echo "Input word: $input\n";
if ($shortest == 0) {
    echo "Exact match found: $closest\n";
} else {
    echo "Did you mean: $closest?\n";
}

?>