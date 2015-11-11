<?php

function get_levenshtein_values(){

    $results = [];

    $row["name"] = "City Name";
    $row["suggestions"] = [

        "City 1",
        "city 2"

    ];


    $results[] = $row;


    return $results;

}


$results = get_levenshtein_values();

var_dump( $results );


foreach( $results as $res ):




endforeach;