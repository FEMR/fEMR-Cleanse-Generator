<?php

ini_set( 'max_execution_time', 0);

include('connect.php');
include('functions.php');

$conn = new mysqli($hostname, $username, $password, $database);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>fEMR City Cleanse Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
   $(function() {
       $('a').click(function() {
           $('#loading').show();
           //return false;
       });        
   });


            function updatedata(str){
              var uniqueID = str;
              var citySelected = $('#citySelected'+str).val();
              var other = $('#other'+str).val();
                $.ajax({
                    url   : "ajax.php",
                    type  : "POST",
                    async : false,
                    data  : {
                        'buttonsave'  : 1,
                        citySelected : citySelected,
                        uniqueID : uniqueID,
                        other : other
                    },
                    success:function()
                    {
                        $('#success'+str).val("").removeClass('hidden');
                    }
                });
        }
    </script>
</head>

<body>

<?php

$per_page = 20;

$pages_query= $conn->query("SELECT COUNT('id') FROM femr.patients");

$row = $pages_query->fetch_assoc();

$pages = ceil($row["COUNT('id')"] / $per_page);

$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

$start = ($page - 1) * $per_page;

$patientCities = "SELECT city, id FROM femr.patients WHERE city != \"unknown\" && city NOT IN (SELECT name FROM cities_dictionary.mission_cities) LIMIT $start, $per_page";


$resultQuery = $conn->query($patientCities);
$countQuery = mysqli_field_count($conn);

?>   <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
		
          <div class="navbar-header">
            <a class="navbar-brand left" href="adminpage.html">fEMR</a>
          </div>
        </div>
  </nav> <div class="jumbotron"> <div class='container'>
<center><img align="middle" src="images/femrLogo.png"></center>
<center><h1> City Cleanse Results </h1></center>
 <center><div class='row col-md-6 col-md-offset-2 custyle'></center>

 <table class='table table-striped custab table-bordered'>


 <thead>
     <tr>
       <th> Input Word </th>
     <th> Suggested </th>
   <th> Action </th>
   </tr>
         </thead>

<?php
$isResults = 0;
while($row = $resultQuery->fetch_assoc()) {
	$results = get_levenshtein_values($row["city"], $conn);
  $cities = $results[0]["suggestions"];

  $maxCount = $results[0]["maxCount"][0];

	if($maxCount != "0"):
		?>
	         <tr>
				<!-- The associated city -->
				<td align='left' width="40%"><h1> <?php  echo $row["city"]; ?> </h1></td>

				<form action="javascript:updatedata('<?php echo $row["id"]; ?>')">
					<td align='left'>
						<div class='btn-group'>
						
						<!-- The associated row ID -->
						<input id="uniqueID" type="hidden" value="<?php echo $row["id"]; ?>">

						<select size="<?php echo $maxCount; ?>" class="form-control" id="citySelected<?php echo $row["id"]; ?>">
							<?php
							for($k = 0; $k < $maxCount; $k++)
							{
								?>
								<!-- Displaying the Cities that are suggested -->
								<option value="<?php echo $cities[$k]; ?>"><?php echo $cities[$k]; ?></option>
								<?php
							}
							 ?>
							<option value="Other">Other</option>
						</select>
						<input type='text' id="other<?php echo $row["id"]; ?>" class="form-control" placeholder="Enter City">

					</td>
						<td align="center">
						<button type="button" onclick="updatedata('<?php echo $row["id"]; ?>')" class="btn btn-success">Update</button>
						<!-- Add success or failure -->
						<div class="hidden" id="success<?php echo$row["id"];?>">Successful Update</div>
					
						</div>
					</td>
	            </form>
	            </td>
	         </tr>
	   <?php
	   $isResults = 1;
    endif;
}
	?>
    </tbody>
    </table>
</body>

<div class="row text-center" id="loading" style="display: none;">
  <img class="center-block" id="loading-image" src="images/page-loader.gif" alt="Loading..." />
</div>

<?php
  // Pagination
  $prev = $page -1;
  $next = $page +1;
  
  echo "<ul class='pagination pagination-lg'>";
  
  //Page 1
  if(!($page <= 1)){
    echo "<li><a href='cityCleanse.php?page=$prev'>Prev</a></li>";
  }
  
  //Loop through make additional pages
  if($pages>=1 && $page<=$pages){
    for($x=1;$x<=$pages;$x++){
      echo ($x == $page) ? 
	  '<li class="active"><a href="?page='.$x.'">'.$x.'</a></li>'
	  :'<li><a href="?page='.$x.'">'.$x.'</a></li>';
    }
  }
  
//Max Page
  if(!($page>=$pages)){
    echo "<li><a href='cityCleanse.php?page=$next'>Next</a></li>";
  }
  echo "</ul>";
  ?>
  </div>
</html>
