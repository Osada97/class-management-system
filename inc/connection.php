<?php
$servername = "sql12.freemysqlhosting.net";
$username = "sql12353968";
$password = "3jWBjRZTfh";
$dbname = "sql12353968";


// Create connection
$connection = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

?> 