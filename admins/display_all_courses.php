


<?php

include('../includes/dbconnection.php');

include("archivecourse.php");

function displayCourses($result){
  if ($result->num_rows > 0) {
  
    echo "<table class='table'><tr><th>序号</th><th>Course Name</th><th>Course ID</th><th>Hours</th><th>Department</th><th>Semester</th><th>Instructor</th><th>Schedule</th><th> </th></tr>";
    // output data of each row
   $row_no=1;
   while($row = $result->fetch_assoc()) {
     
     $rowClass= $row_no%2==1?"table-primary":"table-progress";
     // $id=$row['course_id'];
     $btnEdit= '<a href="admin_updatecourse.php?editid='.$row['course_id'].'"><i class="material-icons">&#xE254;</i></a>';
     $btnDel= '<a href="?delid='.$row['course_id'].'" onclick="return confirm(\'Do you really want to Delete ?\');"><i class="material-icons">&#xE872;</i></a>';
    
    
     // $btnDel= '<button type="submit" name="delid" value="'.$row['course_id'].'" onclick="return confirm(\'Do you really want to Delete ?\');"><i class="material-icons">&#xE872;</i></button>';
    
     echo "<tr class=$rowClass ><td>"
      .$row_no."</td><td>"
      .$row["course_name"]."</td><td>"
      .$row["course_id"]."</td><td>"
      .$row["credit_hours"]."</td><td>"
      .$row["department"]."</td><td>"
      .$row["semester"]."</td><td>"
      .$row["teachername"]."</td><td>"
      .$row["schedule"]."</td><td><form method='post'>"
      .$btnEdit.$btnDel."</form></td></tr>";
      $row_no++;
   }
   echo "</table>";
 } else {
   echo "No Course found!";
 }
}



$sql = "SELECT c.course_id,c.credit_hours,c.course_name,c.schedule,c.department,c.semester,t.teachername FROM courses c left join teacher_course tc on c.course_id = tc.course_id left join teacher t on tc.teacher_id=t.teacher_id";
$result = $con->query($sql);
displayCourses($result);

?>