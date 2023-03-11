<?php
// Connect local database;
include('../includes/dbconnection.php');

// Connect remote database;
// include('../includes/dbconnect_remote.php');

// Get Student ID;
// $queryStudentID=$con->query("SELECT student_id FROM students WHERE student_id ='".$_SESSION ['user_id']."'");
// $row=$queryStudentID->fetch_assoc();
// $_SESSION['user_id']=$row['student_id'];
// session_start();
$user_id = $_SESSION['user_id'];
$courseErr=$scheduleErr="";

function displayCourses($result){
   if ($result->num_rows > 0) {
   
    echo "<table class='table'><tr><th>#</th><th>Course Name</th><th>Course ID</th><th>Hours</th><th>Department</th><th>Semester</th><th>Instructor</th><th>Schedule</th><th> </th></tr>";
    // output data of each row
    $row_no=1;
    while($row = $result->fetch_assoc()) {
      
      $rowClass= $row_no%2==1?"table-primary":"table-progress";
      $id=$row['course_id'];
      $btnSelect= '<form action="#" method="post">
      <input type="text" name="courseID" id="" style="display:none" value="'.$id.'">
      <input type="text"  name="selectedSchedule" id="" style="display:none" value="'.$row["schedule"].'">
      <input type="submit" name="selectBtn" class="btn btn-primary" value="Select">
      </form>';
      echo "<tr class=$rowClass ><td>"
      .$row_no."</td><td>"
      .$row["course_name"]."</td><td>"
      .$row["course_id"]."</td><td>"
      .$row["credit_hours"]."</td><td>"
      .$row["department"]."</td><td>"
      .$row["semester"]."</td><td>"
      .$row["teachername"]."</td><td>"
      .$row["schedule"]."</td><td>"
      .$btnSelect."</td></tr>";
      $row_no++;
    }
    echo "</table>";
  } else {
    echo "Course no found!";
  }
}

function listCourseNameOption($column){
  $sql_course = "SELECT DISTINCT course_name,schedule,department FROM courses";
  $result_course = $GLOBALS['con']->query($sql_course);
    if ($result_course->num_rows > 0) {
     while($row = $result_course->fetch_assoc()) {
     echo "<option value='".$row["$column"]."'>".$row["$column"]."</option>";
    }
  } else {
    echo "<option value='No Course Available'>No Course Available</option>";
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
    <?php listCourseNameOption("course_name");?>

<option value='All Courses'>All Courses</option>
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
<br>
<hr>
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
      displayCourses($result);
    } 
  } 
  
  if(isset($_POST['scheduleBtn'])){
    $schedule=$_POST["schedule"];
    if( $schedule==null){
      echo "<b class='error'>Please select a schedule.</b>";}
      else{
        $sql = "SELECT c.course_id,c.course_name,c.credit_hours,c.schedule,c.department,c.semester,t.teachername FROM courses c left join teacher_course tc on c.course_id = tc.course_id left join teacher t on tc.teacher_id=t.teacher_id WHERE c.schedule='".$schedule."'";
        $result = $con->query($sql);
        displayCourses($result);
      }
  }


  // Click select button to add course to enrollment;
if(isset($_POST["selectBtn"])){
  // $user_id = $_SESSION['user_id'];
  $courseIDSelected=$_POST['courseID'];
 
  $selectedSchedule=$_POST['selectedSchedule'];
  $sqlSceduleCheck="SELECT c.schedule
  FROM course_enrollment e
  INNER JOIN courses c ON e.course_id=c.course_id WHERE c.schedule='$selectedSchedule' AND e.student_id='$user_id';";
  $sqlmycourse= "SELECT *  FROM course_enrollment WHERE course_id='".$courseIDSelected."' AND student_id='$user_id';";
  $result = $con->query($sqlmycourse);
  $rs_scheduleCheck=$con->query($sqlSceduleCheck);
  if($result->fetch_assoc()>0){
    echo "<p style='color:red'><b> You have aready enrolled this course. </b></p>";
  } elseif(!empty($rs_scheduleCheck->fetch_assoc())){
    echo "<p style='color:red'><b> You have schedule confilict. </b></p>";
  }
  else{
    $sqlEnroll="INSERT INTO course_enrollment (student_id,course_id) values('".$user_id."','".$courseIDSelected."'); ";
    if ($con->query($sqlEnroll) === TRUE) {
      echo "<p style='color:blue'><b> Course was successfully enrolled. </b></p>";
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
  }
}
}else{
  
  $sql = "SELECT c.course_id,c.credit_hours,c.course_name,c.schedule,c.department,c.semester,t.teachername FROM courses c left join teacher_course tc on c.course_id = tc.course_id left join teacher t on tc.teacher_id=t.teacher_id";
  $result = $con->query($sql);
  displayCourses($result);
  }
mysqli_close($con);
?>
</div>


