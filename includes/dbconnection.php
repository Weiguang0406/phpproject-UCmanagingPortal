<?php
  //$con=mysqli_connect("localhost", "root", "111111", "studentms");

//$con=mysqli_connect("localhost:3307", "root", "", "studentms");
//if(mysqli_connect_errno())
//{
//    echo "Connection Fail".mysqli_connect_error();
//}




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
