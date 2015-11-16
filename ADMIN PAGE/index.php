<?php

ini_set( 'max_execution_time', 0);

include('connect.php');
include('function.php');

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
        $('#choice').change(function(){
            var selected_item = $(this).val()

            if(selected_item == "other"){
                $('#other').val("").removeClass('hidden');
            }else{
                $('#other').val(selected_item).addClass('hidden');
            }
        });
    </script>
    <script type="text/javascript">
        $(function(){
            $('#save').click(function(){
                var test= $('#test').val();
                var id= $('#idUnique').val();
                $.ajax({
                    url   : "ajax.php",
                    type  : "POST",
                    async : false,
                    data  : {
                        'buttonsave'  : 1,
                        'test' : test,
                        'idUnique'   : id
                    },
                    success:function(result)
                    {
                        alert(result);
                    }
                });
            });
        })
    </script>
</head>
<?php

$limit = 50;

//Grab the count of the number of cities PATIENTS
//SELECT city, id FROM femr.patients WHERE city NOT IN (SELECT name FROM mission_cities)
//SELECT city, id FROM femr.patients LIMIT 5
$patientCities = "SELECT city, id FROM femr.patients WHERE city NOT IN (SELECT name FROM mission_cities WHERE mission_country_id = 72 ) LIMIT $limit";

// LIMIT 250,

$resultQuery = $conn->query($patientCities);
$countQuery = mysqli_field_count($conn);
// while($row = $resultQuery->fetch_array()){
    // for("name" = 0; "name" < $countQuery;"name"++)
        // echo $row["name"];
// }

//Grabbing the count of the cities DICTIONARY
$cityDictionary = "SELECT name FROM femr.mission_cities";
$resultQuery2 = $conn->query($cityDictionary);
$countQuery2 = mysqli_field_count($conn);
// while($row2 = $resultQuery2->fetch_array()){
    // for($j = 0; $j < $countQuery2;$j++)
        // echo $row[$j];
// }
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
$shortest = -1;
while($row = $resultQuery->fetch_assoc()) {

     if( $row['city'] == 'unknown' ) continue;

//    echo '<pre>';
//    var_dump($resultQuery->fetch_assoc());
//     echo '</pre>';
//     die();
    //$dictionary = $resultQuery2->fetch_array();

//	for("name" = 0; "name" < $countQuery - 1; "name"++)
//	{
    $levField = array();
    $cityField = array();

    while ($dictionary = $resultQuery2->fetch_assoc()) {

//    echo '<pre>';
//    var_dump($resultQuery2->fetch_assoc());
//     echo '</pre>';
//     die();
//            $page = 0;
//			for($j = 0; $j < $countQuery2; $j++)
//			{

//                    echo '<pre>';
//                    var_dump($row);
//                    var_dump($dictionary);
//                     echo '</pre>';
//                     die();

//                $page++;
//                $sql = "SELECT name FROM femr.mission_cities
//                        WHERE name LIKE {$row["name"][0]}'%'
//                        LIMIT $page, 1";

        $lev = levenshtein($row['city'], $dictionary['name']);


        // if not exact match, check to see if it's the shortest so far
        if ($lev < "3") {

//                    echo '<pre>';
//                    var_dump($dictionary["name"]);
//                    echo '</pre>';
//                    die();

            // set the closest match, and shortest distance
            array_push($levField, $lev);
            array_push($cityField, $dictionary["name"]);
        }


//			}
    }
    // reset dictionary back to beginning
    $resultQuery2->data_seek(0);


    if(count($levField) > "5")
      $maxCount = 5;
    else
      $maxCount = count($levField);
    array_multisort($levField, $cityField);

  if(count($levField) != "0"):

//         var_dump($row);
//         die();

         ?>

         <tr>
           <td align='left' width="40%"> <?php  echo $row["city"]; ?> </td>

           <td align='left'><div class='btn-group'>
           <form>
               <input type="hidden" name="idUnique" value="<?php echo $row["city"]; ?>">
              <select id="choice" class="form-control" name="test">
                   <?php
                   for($k = 0; $k < $maxCount; $k++){
                    ?>
<option value="<?php echo $cityField[$k]; ?>"><?php echo $cityField[$k]; ?></option>
                  <?php }?>
                   <option value="other">Other</option>
</select>
<input type='text' id="other" class="hidden form-control" name="suggestivecity" value="other2">
  <!-- <input type="text" name="suggestivecity" value="Enter city"> -->

             </td>
                <td align='center' width="5%"><button type="submit" name="update" value="update" id="save" class="btn btn-success">Update</button>
                <!-- <button type="submit" name="newfield" value="newfield" class="btn btn-success">SuggestNew</button> -->
            </form>
            </div></td>
         </tr>
   <? endif;
    $shortest = -1;
//	}
}?>





    </tbody>
    </table>
    </div>
    </div>
</html>
