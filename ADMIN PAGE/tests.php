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
    <script>
    $(document).ready(function(){
      $('#choice').change(function() {
          $('.hideShowTr').css('display','none');
          $('input#' + $(this).val()).css('display','block');
      });
        // $('#choice').change(function(){
        //     var selected_item = $(this).val()
        //
        //     if(selected_item == "other"){
        //         $('#other').val("").removeClass('hidden');
        //     }else{
        //         $('#other').val(selected_item).addClass('hidden');
        //     }
        // });
      });
    </script>
    <script type="text/javascript">
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
                    success:function(result)
                    {
                        alert(result);
                    }
                });
        }
    </script>
</head>
<?php

$limit = 100;
//SELECT * FROM `patients` LIMIT 1250, 1350
$per_page = 100;
$pages_query= $conn->query("SELECT COUNT('id') FROM femr.patients");

$row = $pages_query->fetch_assoc();
$row["COUNT('id')"]; //The count!~

$pages = ceil($row["COUNT('id')"] / $per_page);

$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

$start = ($page - 1) * $per_page;

//Grab the count of the number of cities PATIENTS
//SELECT city, id FROM femr.patients WHERE city NOT IN (SELECT name FROM mission_cities)
//SELECT city, id FROM femr.patients LIMIT 5
//SELECT city, id FROM femr.patients WHERE city NOT IN (SELECT name FROM mission_cities WHERE mission_country_id = 72 ) LIMIT $limit
// $patientCities = "SELECT city, id FROM femr.patients WHERE city NOT IN (SELECT name FROM femr.mission_cities) LIMIT $limit";
$patientCities = "SELECT city, id FROM femr.patients WHERE city NOT IN (SELECT name FROM femr.mission_cities) LIMIT $start, $per_page";
// LIMIT 250,

$resultQuery = $conn->query($patientCities);
$countQuery = mysqli_field_count($conn);
// // while($row = $resultQuery->fetch_array()){
//     // for("name" = 0; "name" < $countQuery;"name"++)
//         // echo $row["name"];
// // }
//
// //Grabbing the count of the cities DICTIONARY
// $cityDictionary = "SELECT name FROM femr.mission_cities";
// $resultQuery2 = $conn->query($cityDictionary);
// $countQuery2 = mysqli_field_count($conn);
// // while($row2 = $resultQuery2->fetch_array()){
//     // for($j = 0; $j < $countQuery2;$j++)
//         // echo $row[$j];
// // }

?>  <div class="jumbotron"> <div class='container'>
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

while($row = $resultQuery->fetch_assoc()) {
	$results = get_levenshtein_values($row["city"], $conn);
  $cities = $results[0]["suggestions"];
  //
  // echo '<pre>';
  // var_dump($cities[0]);
  // echo '</pre>';
  // die();
   $maxCount = $results[0]["maxCount"][0];
	//If results empty don't populate table
	if($maxCount != "0"):
		?>
	         <tr>
						 <!-- THe associated city -->
	           <td align='left' width="40%"> <?php  echo $row["city"]; ?> </td>

	           <form action="javascript:updatedata('<?php echo $row["id"]; ?>')">
               <td align='left'><div class='btn-group'>
							 				<!-- The associated row ID -->
	               <input id="uniqueID" type="hidden" value="<?php echo $row["id"]; ?>">

	              <select class="form-control" id="citySelected<?php echo $row["id"]; ?>">
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
									<!-- <input type='text' id="other" class="hidden form-control" name="suggestivecity" value="other2"> -->
                  <input type='text' id="other<?php echo $row["id"]; ?>" class="form-control" placeholder="Enter City">

               </td>
               <!-- <a class="btn btn-warning btn-sm" href="<?echo $row['id']; ?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> onclick="updatedata('<?php echo $row['id']; ?>')"-->
                    <td><button type="button" onclick="updatedata('<?php echo $row["id"]; ?>')" class="btn btn-success">Update</button> </td>
	                <!-- <button type="submit" name="newfield" value="newfield" class="btn btn-success">SuggestNew</button> -->
	            </form>
	            </div></td>
	         </tr>
	   <? endif;
}
?>
    </tbody>
    </table>

  <?php
  $prev = $page -1;
  $next = $page +1;
  echo "<ul class='pagination'>";
  if(!($page<=1)){
    echo "<li><a href='tests.php?page=$prev'>Prev</a></li>";
  }

  if($pages>=1 && $page<=$pages){
    for($x=1;$x<=$pages;$x++){
      echo ($x == $page) ? '<li><strong><a href="?page='.$x.'">'.$x.'</a></strong></li>':'<li><a href="?page='.$x.'">'.$x.'</a></li>';
    }
  }

  if(!($page>=$pages)){
    echo "<li><a href='tests.php?page=$next'>Next</a></li>";
  }
  echo "</ul>";
  ?>
  </div>
</html>
