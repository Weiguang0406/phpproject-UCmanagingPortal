<?php
session_start();
// $_SESSION['user_id']=1;
$user_id = $_SESSION['user_id'];

// Connect local database;
include('../includes/dbconnection.php');

// // Connect remote database;
// include('../includes/dbconnect_remote.php');

function displayEnrollment($result){
  echo "<table class='table'><tr><th>Student ID</th><th>Course Name</th><th>Course ID</th><th>Grade</th><th></th></tr>";
  if ($result->num_rows > 0) {
       // output data of each row
       $row_no=1;
    while($row = $result->fetch_assoc()) {
      $row_no++;
      $rowClass= $row_no%2==0?"table-primary":"bg-light";
      echo "<tr class=$rowClass ><td>"
      .$row["student_id"]."</td><td>"
      .$row["course_name"]."</td><td>"
      .$row["course_id"]."</td><td>"
      .$row["grade"]."</td><td></td></tr>";
    }
    echo "</table>";
  } else {
    echo "<p style='color:red'><b> You don't have any grade yet. </b></p>";
  
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
 html{
    background-color:#f2f2f2;
  }
  .error{
    color:red;
  }

</style>
<body>
<?php include('../header.php'); ?>
<?php include('studentnavbar.php'); ?>
<main>
  <div class="bg-pink">
<h1>Grade</h1>
<hr>
<?php

$sql_check_student="select * from students where student_id=".$_SESSION['user_id'];
$result=$con->query($sql_check_student);
if($result->num_rows ==1){

  // Display Enrolled courses:(Need to add checking existing course;) 
$sql="select c.course_id, grade,course_name,student_id from course_enrollment ce join courses c on ce.course_id =c.course_id where student_id=".$_SESSION['user_id']." AND grade is not null;";
if($con->query($sql)){
  $result = $con->query($sql);
  displayEnrollment($result);
}else{
  echo "<p style='color:red'><b>Something Went wrong, please refresh the page.</b></p>";
}
}else{
  echo "<p style='color:red'><b>You can not enroll course yet, please contact your admin.</b></p>";
}


?>
</div>
</main>
</body>
</html>