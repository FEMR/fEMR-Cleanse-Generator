<?php
include('../connect.php');
  class Database{
    private static $instance = null;
  $connect = new mysqli($hostname, $username, $password, $database);
  }
?>
