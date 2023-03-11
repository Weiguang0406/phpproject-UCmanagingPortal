


<?php

include('../includes/dbconnection.php');

function displayCourses($result){
  if ($result->num_rows > 0) {
  
    echo "<table class='table'><tr><th>序号</th><th>Course Name</th><th>Course ID</th><th>Hours</th><th>Department</th><th>Semester</th><th>Schedule</th><th> </th></tr>";
    // output data of each row
   $row_no=1;
   while($row = $result->fetch_assoc()) {
     
     $rowClass= $row_no%2==1?"table-primary":"table-progress";
     // $id=$row['course_id'];
    
     $btnRes= '<a href="?resid='.$row['course_id'].'" onclick="return confirm(\'Do you really want to restore the course ?\');">Restore</a>';
    
     // $btnDel= '<button type="submit" name="delid" value="'.$row['course_id'].'" onclick="return confirm(\'Do you really want to Delete ?\');"><i class="material-icons">&#xE872;</i></button>';
    
     echo "<tr class=$rowClass ><td>"
      .$row_no."</td><td>"
      .$row["course_name"]."</td><td>"
      .$row["course_id"]."</td><td>"
      .$row["credit_hours"]."</td><td>"
      .$row["department"]."</td><td>"
      .$row["semester"]."</td><td>"
      .$row["schedule"]."</td><td><form method='post'>"
    .$btnRes."</form></td></tr>";
    $row_no++;
   }
   echo "</table>";
 } else {
   echo "No course in this bin!";
 }
}

// Restore a course:
if(isset($_GET['resid']))
{
$rid=$_GET['resid'];

$checkExist=$con->query("SELECT * FROM courses where course_id='$rid'");
if($checkExist->num_rows ==0){
  // Archive the course to deletedcourses table;
  $sql_achive=$con->query("INSERT INTO courses
  SELECT * FROM deletedcourses where course_id='$rid'");
  $sql=$con->query("delete from deletedcourses where course_id='$rid'");
  echo "<script type='text/javascript'>javascript:history.go(-1); </script>";
}else{

  // return confirm('Same course ID found! Please confirm if you want to remove the course from archived courses list?');
// Remove the course;
$sql=$con->query("delete from deletedcourses where course_id='$rid'");
echo "<script type='text/javascript'>javascript:history.go(-1); </script>";
}
echo "<p class='.text-primary' >The course $rid is restored!</p>";   

// header("location: admin_archivedcourses.php");

} 


  $sql = "SELECT * FROM deletedcourses";
  $result = $con->query($sql);
  displayCourses($result);

?>