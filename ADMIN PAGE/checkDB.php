<?php
	include('connect.php');
	include('createDB.php');
	try {
		$mysqli = new mysqli($hostname, $username, $password, $dictionaryDB);
	} catch (\Exception $e) {
		echo $e->getMessage(), PHP_EOL;
	}
	if ($mysqli->select_db($dictionaryDB) === false) {
		createDB($mysqli);
	}
	//$mysqli->select_db($dictionaryDB);

	$sqlSource = file_get_contents('./cityDump/mission_cities.sql');
	
	$results	= mysqli_multi_query($mysqli, $sqlSource);

	var_dump($results);
	function createDB($mysqli){
	$sql = "CREATE DATABASE cities_dictionary";

	echo $mysqli->query($sql);
	echo "test";
	
	
	
	}
?>