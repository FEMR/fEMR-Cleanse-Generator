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
  
	//  Grab Cities Dictionary
    $cityDictionary = "SELECT name FROM femr.mission_cities WHERE name LIKE '$input[0]%'";
	$resultQuery2 = $conn->query($cityDictionary);


	//Parse through entire dictionary
	while($dictionary = $resultQuery2->fetch_assoc()){
		//Lev to compare city to dictionary
		$lev = levenshtein($input, $dictionary['name']);
		if($lev < "3"){
		  array_push($results[0]["value"], $lev);
		  array_push($results[0]["suggestions"], $dictionary["name"]);
		}
	}
	
	array_multisort($results[0]["value"], $results[0]["suggestions"]);


	if(count($results[0]["suggestions"]) > "5")
		array_push($results[0]["maxCount"], 5);
	else
		array_push($results[0]["maxCount"], count($results[0]["suggestions"]));

	
	return $results;
}
?>
