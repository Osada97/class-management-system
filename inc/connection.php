<?php
$servername = "lankaelearn.com";
$username = "lankaelearn_root";
$password = "Y{zuX4_w#-}D";
$dbname = "lankaelearn_elearn";


// Create connection
$connection = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

?> 