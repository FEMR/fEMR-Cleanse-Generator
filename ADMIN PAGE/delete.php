<?php

ini_set( 'max_execution_time', 0);

include('connect.php');
include('functions.php');

$conn = new mysqli($hostname, $username, $password, $database);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

    $result= $conn->query("select id, name,count(*) from femr.mission_cities group by name having count(*)>1");
    while($row = $result->fetch_assoc()){
        $conn->query("delete from femr.mission_cities where name='{$row['name']}' and id <> {$row['id']}");
    }

?>

