<?php

include('../connect.php');
  class City{
    private $db,
    $city,
    $suggestive_cities;

    //Constructor to connect to DB
    public function __construct($city = null)
    {
            $this->$db = new mysqli($hostname, $username, $password, $database);
    }

    public function updateCity($id = null, $fields = array()){

      if(!$this->db->update('id', $id, 'cityname', $fields)){
        throw new exception('Problem updating city.');
      }
    }

  }//End City Class
 ?>
