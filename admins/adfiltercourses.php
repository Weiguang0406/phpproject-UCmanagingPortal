<?php

// // Check if the user is logged in and if has the right priviledge, otherwise redirect to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true|| $_SESSION["roles"]!=="student"){
//     header("location: login.php");
//     exit;
// }
// Connect local database;
include('../includes/dbconnection.php');

// Connect remote database;
// include('../includes/dbconnect_remote.php');

// Get Student ID;
// $queryStudentID=$con->query("SELECT student_id FROM students WHERE username ='".$_SESSION ['username']."'");
// $row=$queryStudentID->fetch_assoc();
// $_SESSION['studentID']=$row['student_id'];

// $studentID = $_SESSION['studentID'];

$courseErr=$scheduleErr="";

function admindisplayCourses($result){
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
    echo "Course no found!";
  }
}

function listCourseNameOption($column){
  $sql_course = "SELECT DISTINCT course_name,schedule,department,semester FROM courses";
  $result_course = $GLOBALS['con']->query($sql_course);
    if ($result_course->num_rows > 0) {
     while($row = $result_course->fetch_assoc()) {
     echo "<option value='".$row["$column"]."'>".$row["$column"]."</option>";
    }
  } else {
    echo "<option value='No Course Available'>No Course Available</option>";
  }
}





// Remove a course;


include('archivecourse.php');


// if(isset($_GET['delid']))
// {
// $rid=$_GET['delid'];

// $checkExist=$con->query("SELECT * FROM deletedcourses where course_id='$rid'");
// if($checkExist->num_rows ==0){
//   // Archive the course to deletedcourses table;
//   $sql_achive=$con->query("INSERT INTO deletedcourses
//   SELECT * FROM courses where course_id='$rid'");
//   $con->query("delete FROM courses c join teacher_course tc on c.course_id = tc.course_id join teacher t on tc.teacher_id=t.teacher_id where c.course_id='$rid'");
// }else{
// // Remove the course;
// $sql=$con->query("delete FROM courses c left join teacher_course tc on c.course_id = tc.course_id join teacher t on tc.teacher_id=t.teacher_id where c.course_id='$rid'");
// }
// echo "<p class='.text-primary' >The course $rid is archived!</p>";    

// $sql="delete FROM courses c left join teacher_course tc on c.course_id = tc.course_id join teacher t on tc.teacher_id=t.teacher_id where c.course_id='$rid'";

// if($con->query($sql)){
//   echo "<p class='.text-primary' >The course $rid is removed!</p>"; 
// }else{
//   echo "<p class='.text-primary' >Something went wrong please try it again!</p>"; 
// };


// header("location: adfiltercourses.php");

// } 

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
    <?php listCourseNameOption("course_name");?>
  </select>
  <input type="submit" name="courseBtn" value="Filter">
  </form>
  <span class="error"> <?php echo $courseErr;?></span>
  </div>

  <!-- Filter course by schedule -->
  <div class="col">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <label for="schedule">Filer by Schedule</label>
  <select name="schedule" id="schedule">
  <option value=''>schedule</option>
  <?php  listCourseNameOption("schedule");?>
  </select>
  <input type="submit" name="scheduleBtn" value="Filter">
  <span class="error"> <?php echo $scheduleErr;?></span>
</div>
</div>
<br><br>
<div>
<?php
// Display filtered courses PHP;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  if (isset($_POST['courseBtn'])) {
    $selectCourse=$_POST["courseName"];
   if($selectCourse==null){
      echo "<b class='error'>Please select a course!</b>";
    }else{
      $sql = "SELECT c.course_id,c.course_name,c.credit_hours,c.schedule,c.department,c.semester,t.teachername FROM courses c left join teacher_course tc on c.course_id = tc.course_id left join teacher t on tc.teacher_id=t.teacher_id WHERE c.course_name='".$selectCourse."'";
      $result = $con->query($sql);
      admindisplayCourses($result);
    } 
  } 
  
  if(isset($_POST['scheduleBtn'])){
    $schedule=$_POST["schedule"];
    if( $schedule==null){
      echo "<b class='error'>Please select a schedule.</b>";}
      else{
        $sql = "SELECT c.course_id,c.course_name,c.credit_hours,c.schedule,c.department,c.semester,t.teachername FROM courses c left join teacher_course tc on c.course_id = tc.course_id left join teacher t on tc.teacher_id=t.teacher_id WHERE c.schedule='".$schedule."'";
        $result = $con->query($sql);
        admindisplayCourses($result);
      }
  }

}else{
  
$sql = "SELECT c.course_id,c.credit_hours,c.course_name,c.schedule,c.department,c.semester,t.teachername FROM courses c left join teacher_course tc on c.course_id = tc.course_id left join teacher t on tc.teacher_id=t.teacher_id";
$result = $con->query($sql);
admindisplayCourses($result);
}

mysqli_close($con);
?>
</div>


