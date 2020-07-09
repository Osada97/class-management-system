<?php
$servername = "localhost";
$username = "dronxfew_user";
$password = "y{OJzksO2(Jw";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?> 