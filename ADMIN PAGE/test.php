<?php
$hostname = "localhost";
$username = "root";
$password = "root";
$database = "femr";
// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

//Get data and store
$from = 0;
$to = 30;
$query = "SELECT city FROM patients LIMIT ?,?";
$result = $mysqli->prepare($query);
$result->bind_param('ii', $from, $to);
$result->execute();

$result->bind_result($City);
while ($result->fetch())
	{
	$customers[] = array(
		'City' => $City
	);
	}
echo json_encode($customers);
/* close statement */
$result->close();
/* close connection */
$mysqli->close();


$(document).ready(function () {
    // prepare the data
    var source ={
        datatype: "json",
        datafields: [{ { name: 'City' },],
        url: 'data.php'
    };
    $("#jqxgrid").jqxGrid({
        source: source,
        theme: 'classic',
        columns: [{datafield: 'City', width: 120 }]
    });
});
?>



<!DOCTYPE html>


<link rel="stylesheet" href="styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="styles/jqx.classic.css" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="scripts/jqxcore.js"></script>
<script type="text/javascript" src="scripts/jqxbuttons.js"></script>
<script type="text/javascript" src="scripts/jqxscrollbar.js"></script>
<script type="text/javascript" src="scripts/jqxmenu.js"></script>
<script type="text/javascript" src="scripts/jqxdata.js"></script>
<script type="text/javascript" src="scripts/jqxgrid.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">


<html>

<div id="jqxgrid"></div>
<head>
<title>
	fEMR Admin Page
</title>
</head>

<body>



</body>


<footer>
    <hr />
    <div class="row">
        <div class="col-xs-6">
            <p class ="text-left">fEMR 2.1.5 &copy; 2015</p>
        </div>
        <div class="col-xs-6">
            <p class="text-right">Designed for use in Google Chrome</p>
        </div>
    </div>
</footer>

        </div>

</html>
