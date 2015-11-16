<?php

    ini_set('display_errors', 1);

	//Global array
	$GLOBALS['config'] = array(
		'mysql' => array(
			'host' => 'localhost',
			'username' => 'root',
			'password' => 'root',
			'db' => 'femr'
		)
	);

	//Auto load parse in functions. spl = standard php lib
	//Only requiring classes as we need them
	spl_autoload_register(function($class) {
		require_once 'classes/' . $class . '.php';
	});




?>
