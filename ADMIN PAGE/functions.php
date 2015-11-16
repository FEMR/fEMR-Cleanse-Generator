<?php
ini_set( 'max_execution_time', 0);

include('connect.php');



function get_levenshtein_values($input){
  $conn = new mysqli($hostname, $username, $password, $database);

  if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
  }
    $results = [];

    $row["name"] = $input;
    $row["suggestions"] = array();
    $row["value"] = array();
    $row["maxCount"] = array();
    echo '<pre>';
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

    $cityDictionary = "SELECT name FROM femr.mission_cities WHERE name";
    // echo $cityDictionary;
  //  $resultQuery2 = $conn->query($cityDictionary);
    var_dump($conn->query($cityDictionary));
$dictionary = $resultQuery2->fetch_assoc();
    echo '<pre>';
    //This outputs the suggestive name
    var_dump($dictionary);
     echo '</pre>';
     die();
  $levField = array();
  $cityField = array();

  //Parse through entire dictionary
  while($dictionary = $resultQuery2->fetch_assoc()){
    //Lev to compare city to dictionary
    $lev = levenshtein($input, $dictionary['name']);
    if($lev < "3"){
      array_push($results[0]["suggestions"], $lev);
      array_push($results[0]["value"], $dictionary["name"]);
    }
    echo "blah";
  }


  if(count($results[0]["value"]) > "5")
    $maxCount = 5;
  else
    $maxCount = count($results[0]["value"]);

  array_multisort($results[0]["value"], $results[0]["suggestions"]);

//

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
