
<?php
// Connect local database;
 include('../includes/dbconnection.php');

// Connect remote database;
//include('../includes/dbconnect_remote.php');


session_start();
$_SESSION['studentID']=1;
$studentID = $_SESSION['studentID'];


$courseErr=$scheduleErr="";

function displayCourses($result){


  if ($result->num_rows > 0) {

    echo "<table class='table'><tr><th>Course Name</th><th>Code</th><th>Hours</th><th>Department</th><th>Instructor</th><th>Schedule</th><th> </th></tr>";
    // output data of each row
    $row_no=1;
    while($row = $result->fetch_assoc()) {
      $row_no++;
      $rowClass= $row_no%2==0?"table-primary":"table-progress";
      $id=$row["course_id"];
      $btnSelect= '<form method="post">
      <input type="number" name="course_id" id="" style="display:none" value="'.$id.'">
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

function displayEnrollment($result){

  if ($result->num_rows > 0) {
    echo "<table class='table'><tr><th>Student ID</th><th>Course ID</th><th>Course Name</th><th>Schedule</th><th>Instructor</th><th> </th></tr>";
    // output data of each row
    $row_no=1;
    while($row = $result->fetch_assoc()) {
      $row_no++;
      $rowClass= $row_no%2==0?"table-primary":"table-progress";
      $delid = $row["course_id"];
      $btnSelect= '<form method="post">
  <input type="number" name="enrollmentID" id="" style="display:none" value="'.$delid.'">
  <input type="submit" name="unselectBtn" class="btn btn-primary" value="Unselect">
  </form>';
       echo "<tr class=$rowClass><td>"
      .$row["StudentID"]."</td><td>"
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

function listCourseNameOption(){
  $sql_course = "SELECT DISTINCT course_name FROM courses";
  $result_course = $con->query($sql_course);
    if ($result_course->num_rows > 0) {
     while($row = $result_course->fetch_assoc()) {
     echo "<option value='".$row["course_name"]."'>".$row["course_name"]."</option>";
    }
  } else {
    echo "No Course Available";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Home</title>
</head>
<?php $currentPage = 'student_portal'; ?>
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

<!-- Main Content -->
<main>
<div class="bg-pink m-3 ">
  <h2 class="m-3 ">Courses  </h2>
 <hr>
 <!-- Filter course HTML -->
<h2>Select course</h2>
<div class="row">
  <div class="col">
  <form id="courseForm"  method="post">
  <label for="courseName">Filter by CourseName</label>
  <select name="courseName" id="courseName">
  <option value=''>Course Name</option>
  <!-- Set the option values based on Course Database -->
    <?php
 $sql_course = "SELECT DISTINCT course_name FROM courses";
 $result_course = $con->query($sql_course);
   if ($result_course->num_rows > 0) {
    while($row = $result_course->fetch_assoc()) {
    echo "<option value='".$row["course_name"]."'>".$row["course_name"]."</option>";
   }
 } else {
   echo "<option value='No Course Available'>No Course Available</option>";
 }
?>
<!-- Filter course by schedule -->
<option value='All Courses'>All Courses</option>
  </select>
  <input type="submit" name="courseBtn" value="Filter">
  </form>
  <span class="error"> <?php echo $courseErr;?></span>
  </div>
  <div class="col">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <label for="schedule">Filer by Schedule</label>
  <select name="schedule" id="schedule">
  <option value=''>schedule</option>
  <?php
  $sql_schedule = "SELECT DISTINCT schedule FROM courses";
$result_schedule = $con->query($sql_schedule);
  if ($result_schedule->num_rows > 0) {
  while($row = $result_schedule->fetch_assoc()) {
   echo "<option value='".$row["schedule"]."'>".$row["schedule"]."</option>";
  }
} else {
  echo "<option value=''>schedule</option>";
}
?>
  </select>
  <input type="submit" name="scheduleBtn" value="Filter">
  <span class="error"> <?php echo $scheduleErr;?></span>
</div>
<br><br>
<div>
<?php
// Display filtered courses PHP;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST['courseBtn'])) {
    $selectCourse=$_POST["courseName"];
    if($selectCourse=='All Courses'){
      $sql = "SELECT course_name, course_id,credit_hours,department,instructor_name,schedule FROM courses";
      $result = $con->query($sql);
      displayCourses($result);
    }elseif($selectCourse==null){
      echo "<b class='error'>Please select a course!</b>";
    }else{
      $sql = "SELECT course_id, course_name, course_id,credit_hours,department,instructor_name,schedule FROM courses WHERE course_name='".$selectCourse."'";
      $result = $con->query($sql);
      displayCourses($result);
    }
  }

  if(isset($_POST['scheduleBtn'])){
    $schedule=$_POST["schedule"];
    if( $schedule==null){
      echo "<b class='error'>Please select a schedule.</b>";}
      else{
        $sql = "SELECT id, course_name, course_id,credit_hours,department,instructor_name,schedule FROM courses WHERE schedule='".$schedule."'";
        $result = $con->query($sql);
        displayCourses($result);
      }
  }

  // Click select button to add course to enrollment;
if(isset($_POST["selectBtn"])){
  // $studentID = $_SESSION['studentID'];
  $courseIDSelected=$_POST['course_id'];
  $selectedSchedule=$_POST['selectedSchedule'];
  $sqlSceduleCheck="SELECT e.course_id,c.schedule
  FROM course_enrollment e
  INNER JOIN courses c ON e.course_id=c.course_id WHERE c.schedule='$selectedSchedule';";
  $sqlmycourse= "SELECT *  FROM course_enrollment WHERE course_id='$courseIDSelected';";

  $result = $con->query($sqlmycourse);
  $rs_scheduleCheck=$con->query($sqlSceduleCheck);
  if($result->fetch_assoc()>0){
    echo "<p style='color:red'><b> You have aready enrolled this course. </b></p>";
    echo "<p style='color:red'><b> You have aready enrolled this course. </b></p>";
  } elseif(!empty($rs_scheduleCheck->fetch_assoc())){
    echo "<p style='color:red'><b> You have schedule confilict. </b></p>";
  }
  else{

    $sqlEnroll="INSERT INTO course_enrollment (Student_ID,course_id) values('$studentID','$courseIDSelected'); ";

      echo "<h1>  ' $sqlEnroll'</h1>";
      if ($con->query($sqlEnroll) === TRUE) {
      echo "<p style='color:blue'><b> Course was successfully enrolled. </b></p>";
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
  }
}
}
?>
</div>
<hr>
<!--  My enrolled courses section -->
<div>
  <h2>My current courses</h2>
<?php

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
//$sql="SELECT e.id,e.StudentID, e.course_id, c.course_name,c.schedule,c.instructor_name
//FROM course_enrollment e
//INNER JOIN courses c ON e.course_id=c.id WHERE e.grade is null AND e.StudentID = $studentID;";
$sql="SELECT e.id,s.studentname, e.course_id, c.course_name,c.schedule,c.instructor_name
FROM course_enrollment e 
INNER JOIN courses c ON e.course_id=c.course_id
INNER join students s on s.student_id=e.student_id
WHERE e.grade is null AND e.Student_ID = $studentID;";


if($con->query($sql)){
  $result = $con->query($sql);
  displayEnrollment($result);
}else{
  echo "You currently have no courses.";
}

?>
</div>
</div>
<?php
mysqli_close($con);
?>
</main>

</body>
</html>