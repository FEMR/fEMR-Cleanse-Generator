<?php
	include('connect.php');
	include('createDB.php');
	try {
		$mysqli = new mysqli($hostname, $username, $password);
	} catch (\Exception $e) {
		echo $e->getMessage(), PHP_EOL;
	}
	if ($mysqli->select_db($dictionaryDB) === false) {
		createDB();
	}
	
	function createDB(){
	$db = new PDO($hostname, $username, $password);
	echo "test";
	
	
	
	}
?>