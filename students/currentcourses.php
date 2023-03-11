<?php

// 
$student_id = $_SESSION['user_id'];

// Connect local database;
include('../includes/dbconnection.php');


function displayEnrollment($result){
  
  if ($result->num_rows > 0) {
    echo "<table class='table'><tr><th>#</th><th>Student ID</th><th>Course ID</th><th>Course Name</th><th>Schedule</th><th>Instructor</th><th> </th></tr>";
    // output data of each row
    $row_no=1;
    while($row = $result->fetch_assoc()) {
      
      $rowClass= $row_no%2==1?"table-primary":"table-progress";
      $delid = $row["id"];
      $btnSelect= '<form method="post">
  <input type="text" name="enrollmentID" id="" style="display:none" value="'.$delid.'">
  <input type="submit" name="unselectBtn" class="btn btn-primary" value="Unselect">
  </form>';
      echo "<tr class=$rowClass><td>"
      .$row_no."</td><td>"
      .$row["student_id"]."</td><td>"
      .$row["course_id"]."</td><td>"
      .$row["course_name"]."</td><td>"
      .$row["schedule"]."</td><td>"
      .$row["teachername"]."</td><td>"
      .$btnSelect."</td></tr>";
      $row_no++;
    }
    echo "</table>";
    
  } else {
    echo "<p style='color:red'><b> You currently have no courses in you schedule. </b></p>";
  }
}

// Remove course from enrollment;
if(isset($_POST["unselectBtn"])){
  
  $courseToRemove=$_POST['enrollmentID'];
  $sql = 'DELETE FROM course_enrollment WHERE id="'.$courseToRemove.'";';

if ($con->query($sql) === TRUE) {
  echo "Course deleted successfully";
} else {
  echo "Error deleting record: " . $con->error;
}
}

// Display Enrolled courses: 
$sql="SELECT c.course_name,c.course_id, ce.id, ce.student_id, c.semester, c.schedule, tc.teachername, ce.grade FROM courses c inner JOIN (SELECT id,course_id, student_id, grade From course_enrollment WHERE grade is null AND student_id = $student_id) ce on c.course_id =ce.course_id left join (Select tc.course_id, t.teachername from teacher_course tc join teacher t on tc.teacher_id=t.teacher_id) tc on ce.course_id=tc.course_id;";
if($con->query($sql)){
  $result = $con->query($sql);
  displayEnrollment($result);
}else{
  echo "You currently have no courses.";
}
mysqli_close($con);
?>

