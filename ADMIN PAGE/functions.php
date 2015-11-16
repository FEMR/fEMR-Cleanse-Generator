<?php
ini_set( 'max_execution_time', 0);

include_once('connect.php');

function get_levenshtein_values($input, $conn){

    $results = [];

    $row["name"] = $input;
    $row["suggestions"] = array();
    $row["value"] = array();
    $row["maxCount"] = array();
    $results[] = $row;
    //This outputs the suggestive name

// echo $input[0];
//      die();
      //  echo '<pre>';
      //  //This outputs the suggestive name
      //  echo ($results[0]["name"]);
      //   echo '</pre>';
      //   die();

        // array_push($results[0]["suggestions"], "blah");
        // array_push($results[0]["suggestions"], "blah2");
        // array_push($results[0]["suggestions"], "blah3");
        //
        // echo '<pre>';
        // //This outputs the suggestive name
        // var_dump($results[0]["suggestions"]);//whole var
        // echo($results[0]["suggestions"][0]); //blah
        //  echo '</pre>';
        //  die();

        // array_push($results[0]["value"], "1");
        // array_push($results[0]["value"], "3");
        // array_push($results[0]["value"], "2");
        //
        // echo '<pre>';
        // //This outputs the suggestive name
        // var_dump($results[0]["value"]);//
        // echo($results[0]["value"][0]); // outputs 1
        //  echo '</pre>';
        //  die();

  //  Grab Patient Cities
    // $queryPatientCities = "SELECT city, id
    // FROM femr.patients
    // WHERE city
    // NOT IN
    // (SELECT name FROM mission_cities WHERE mission_country_id = 72 )
    // LIMIT $limit";
    // $resultQuery = $conn->query($queryPatientCities);
    // $countQuery = mysqli_field_count($conn);

  //  Grab Cities Dictionary

    $cityDictionary = "SELECT name FROM femr.mission_cities WHERE name LIKE '$input[0]%'";

  $resultQuery2 = $conn->query($cityDictionary);

  $levField = array();
  $cityField = array();

  //Parse through entire dictionary
  while($dictionary = $resultQuery2->fetch_assoc()){
    //Lev to compare city to dictionary
    $lev = levenshtein($input, $dictionary['name']);
    if($lev < "3"){
      array_push($results[0]["value"], $lev);
      array_push($results[0]["suggestions"], $dictionary["name"]);
    }
  }


  if(count($results[0]["value"]) > "5")
    array_push($results[0]["maxCount"], 5);
  else
      array_push($results[0]["maxCount"], count($results[0]["value"]));

      array_multisort($results[0]["value"], $results[0]["suggestions"]);


    return $results;
}

// $results = get_levenshtein_values();

//        echo '<pre>';
//        //This outputs the suggestive name
// var_dump( $results );
//         echo '</pre>';
//         die();


//
// foreach( $results as $res ):
//
//
//
//
// endforeach;
?>
