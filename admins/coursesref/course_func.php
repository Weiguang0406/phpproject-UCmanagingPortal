<?php


// Admin
function admindisplayCourses($result){
  if ($result->num_rows > 0) {
  
   echo "<table class='table'><tr><th>Course Name</th><th>Course ID</th><th>Hours</th><th>Department</th><th>Instructor</th><th>Schedule</th><th> </th></tr>";
   // output data of each row
   $row_no=1;
   while($row = $result->fetch_assoc()) {
     $row_no++;
     $rowClass= $row_no%2==0?"table-primary":"table-progress";
     // $id=$row['course_id'];
     $btnEdit= '<a href="admin_updatecourse.php?editid='.$row['course_id'].'"><i class="material-icons">&#xE254;</i></a>';
     $btnDel= '<a href="?delid='.$row['course_id'].'" onclick="return confirm(\'Do you really want to Delete ?\');"><i class="material-icons">&#xE872;</i></a>';
    
    
     // $btnDel= '<button type="submit" name="delid" value="'.$row['course_id'].'" onclick="return confirm(\'Do you really want to Delete ?\');"><i class="material-icons">&#xE872;</i></button>';
    
     echo "<tr class=$rowClass ><td>"
     .$row["course_name"]."</td><td>"
     .$row["course_id"]."</td><td>"
     .$row["credit_hours"]."</td><td>"
     .$row["department"]."</td><td>"
     .$row["instructor_name"]."</td><td>"
     .$row["schedule"]."</td><td><form method='post'>"
     .$btnEdit.$btnDel."</form></td></tr>";
   }
   echo "</table>";
 } else {
   echo "Course no found!";
 }
}

function listCourseNameOption($column){
 $sql_course = "SELECT DISTINCT course_name,schedule,department,instructor_name FROM courses";
 $result_course = $GLOBALS['con']->query($sql_course);
   if ($result_course->num_rows > 0) {
    while($row = $result_course->fetch_assoc()) {
    echo "<option value='".$row["$column"]."'>".$row["$column"]."</option>";
   }
 } else {
   echo "<option value='No Course Available'>No Course Available</option>";
 }
}

// Student:
function studentdisplayEnrollment($result){
  
  if ($result->num_rows > 0) {
    echo "<table class='table'><tr><th>Student ID</th><th>Course ID</th><th>Course Name</th><th>Schedule</th><th>Instructor</th><th> </th></tr>";
    // output data of each row
    $row_no=1;
    while($row = $result->fetch_assoc()) {
      $row_no++;
      $rowClass= $row_no%2==0?"table-primary":"table-progress";
      $delid = $row["id"];
      $btnSelect= '<form method="post">
  <input type="number" name="enrollmentID" id="" style="display:none" value="'.$delid.'">
  <input type="submit" name="unselectBtn" class="btn btn-primary" value="Unselect">
  </form>';
      echo "<tr class=$rowClass><td>"
      .$row["student_id"]."</td><td>"
      .$row["course_id"]."</td><td>"
      .$row["course_name"]."</td><td>"
      .$row["schedule"]."</td><td>"
      .$row["instructor_name"]."</td><td>"
      .$btnSelect."</td></tr>";
    }
    echo "</table>";
    
  } else {
    echo "<p style='color:red'><b> You currently have no courses in you schedule. </b></p>";
  }
}

function displayCourses($result){
  if ($result->num_rows > 0) {
  
   echo "<table class='table'><tr><th>Course Name</th><th>Course ID</th><th>Hours</th><th>Department</th><th>Instructor</th><th>Schedule</th><th> </th></tr>";
   // output data of each row
   $row_no=1;
   while($row = $result->fetch_assoc()) {
     $row_no++;
     $rowClass= $row_no%2==0?"table-primary":"table-progress";
     $id=$row['course_id'];
     $btnSelect= '<form action="#" method="post">
     <input type="text" name="courseID" id="" style="display:none" value="'.$id.'">
     <input type="text"  name="selectedSchedule" id="" style="display:none" value="'.$row["schedule"].'">
     <input type="submit" name="selectBtn" class="btn btn-primary" value="Select">
     </form>';
     echo "<tr class=$rowClass ><td>"
     .$row["course_name"]."</td><td>"
     .$row["course_id"]."</td><td>"
     .$row["credit_hours"]."</td><td>"
     .$row["department"]."</td><td>"
     .$row["instructor_name"]."</td><td>"
     .$row["schedule"]."</td><td>"
     .$btnSelect."</td></tr>";
   }
   echo "</table>";
 } else {
   echo "Course no found!";
 }
}


?>