<?php
$servername = "sql12.freemysqlhosting.net";
$username = "sql12353968";
$password = "3jWBjRZTfh";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?> 