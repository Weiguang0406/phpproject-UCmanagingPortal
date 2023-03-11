<?php

// 
// Connect local database;
include('../includes/dbconnection.php');

$courseErr="";
function displayEnrollment($result){
  
  if ($result->num_rows > 0) {
    echo "<table class='table'><tr><th>序号</th><th>Course Name</th><th>Course ID</th><th>Semester</th><th>Teacher</th><th>Schedule</th><th>Total Enrollment</th></tr>";
    // output data of each row
    $row_no=1;
    while($row = $result->fetch_assoc()) {
      
      $rowClass= $row_no%2==1?"table-primary":"table-progress";
      $courseid = $row["course_id"];
      $btnDetail= '<form method="post">
  <input type="number" name="courseid" id="" style="display:none" value="'.$courseid.'">
  <input type="submit" name="detailBtn" class="btn btn-primary" value="Detail">
  </form>';
      echo "<tr class=$rowClass><td>"
      .$row_no."</td><td>"
      .$row["course_name"]."</td><td>"
      .$row["course_id"]."</td><td>"
      .$row["semester"]."</td><td>"
      .$row["teachername"]."</td><td>"
      .$row["schedule"]."</td><td>"
      .$row["totalEnroll"]."</td></tr>";
      $row_no++;
    }
    echo "</table>";
    
  } else {
    echo "<p style='color:red'><b> There is no status!. </b></p>";
  }
}

?>


<div>
<div class="row">
  <!-- Filter course by course name -->
  <div class="col">
  <form id="courseForm"  method="post">
  <label for="courseName">Filter by CourseName</label>
  <select name="courseName" id="courseName">
  <option value=''>Course Name</option>
  <!-- Set the option values based on Course Database -->

  </select>
  <input type="submit" name="courseBtn" value="Filter">
  </form>
  <span class="error"> <?php echo $courseErr;?></span>
  </div>

<br><br>
<div>

<?php
// Display course enrolling status: 
$sql="SELECT c.course_name,c.course_id, c.semester, tc.teachername, c.schedule, ce.totalEnroll
FROM courses c
Left JOIN (SELECT course_id, COUNT(*) as totalEnroll From course_enrollment group by course_id) ce on c.course_id =ce.course_id left join (Select tc.course_id, t.teachername from teacher_course tc join teacher t on tc.teacher_id=t.teacher_id) tc on c.course_id=tc.course_id;";
if($con->query($sql)){
  $result = $con->query($sql);
  displayEnrollment($result);
}else{
  echo "Something wrong, please try again.";
}
mysqli_close($con);
?>

