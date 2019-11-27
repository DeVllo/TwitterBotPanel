<?php
$servername = "localhost";
$username = "u852560018_pcu";
$password = "adlasta83110";
$database = "u852560018_pcu";

date_default_timezone_set('America/Argentina/Buenos_Aires');
$con=mysqli_connect($servername,$username,$password,$database);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  mysqli_query($con,"SELECT * FROM pcu_db");  
?>