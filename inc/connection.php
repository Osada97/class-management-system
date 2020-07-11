<?php
$servername = "sql12.freemysqlhosting.net";
$username = "sql12353968";
$password = "3jWBjRZTfh";


// Create connection
$connection = new mysqli($servername, $username, $password);

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

?> 