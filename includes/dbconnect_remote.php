<?php
// Connect to database;
$servername = "34.23.212.235";
$username = "phpuser";
$password = "";
$dbname = "studentms";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

?>