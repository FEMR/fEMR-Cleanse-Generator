<?php
    //database configuration
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'root';
    $dbName = 'femr';

    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    //get search term
    $searchTerm = $_GET['term'];

    //get matched data from skills table
    $query = $db->query("SELECT * FROM citytest2 WHERE cityname LIKE '%$searchTerm%' ORDER BY cityname ASC");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['cityname'];
    }

    //return json data
    echo json_encode($data);
?>
