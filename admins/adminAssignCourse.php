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
$user_id = $_GET['user_id'];
$inputErr="";

// Function
function displayCoursesAssignment($result){
  if ($result->num_rows > 0) {
  
    echo "<table class='table'><tr><th>#</th><th>Course Name</th><th>Course ID</th><th>Hours</th><th>Department</th><th>Semester</th><th>Schedule</th><th> </th></tr>";
    // output data of each row
    $teacher_id= $GLOBALS['user_id'];
   $row_no=1;
   while($row = $result->fetch_assoc()) {
    $id=$row['course_id'];

    
$sql_check="SELECT * from teacher_course where teacher_id='$teacher_id' AND course_id='$id'";
$result2=$GLOBALS['con']->query($sql_check);
$availability =($result2->num_rows>0)? 'disabled':'';


     $rowClass= $row_no%2==1?"table-primary":"table-progress";
    
     $btnAssign= ' <input type="text" name="courseID" id="" style="display:none" value="'.$id.'">
     <input type="submit" name="selectBtn" class="btn btn-primary "'.$availability.' " value="Assign">';
    
    //  $btnAssign= '<a href="adminAssignCourse.php?user_id='.$teacher_id.'?cid='.$row['course_id'].'">Assign</i></a>';
     // $btnDel= '<button type="submit" name="delid" value="'.$row['course_id'].'" onclick="return confirm(\'Do you really want to Delete ?\');"><i class="material-icons">&#xE872;</i></button>';
    
    //  $location="#";


     echo "<tr class=$rowClass ><td>"
      .$row_no."</td><td>"
      .$row["course_name"]."</td><td>"
      .$row["course_id"]."</td><td>"
      .$row["credit_hours"]."</td><td>"
      .$row["department"]."</td><td>"
      .$row["semester"]."</td><td>"
      .$row["schedule"]."</td><td><form action='#' method='post'>"
      .$btnAssign."</form></td></tr>";
      $row_no++;
   }
   echo "</table>";
 } else {
   echo "No records found!";
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home</title>
</head>
<style>
    <style>
  .btn-group{
    margin-left: 3%;
    position: fixed;
  }
  .btn-group a{
    border:none;
    /* font-size: 20px; */
  }
  .btn-group button{
    border:none;
    /* font-size: 20px; */
  }
  .main{
    margin-top: 120px;
  }
</style>
</style>
<body>
<?php include('../header.php'); ?>
<?php include('adminnavbar.php'); ?>
<main >
    <div class="bg-pink m-3 ">

    <!-- <a href="teacher_profile_edit_firstpage.php?user_id=">Edit </a> -->

    <div style="z-index: 10; margin-left: 30px;"><a href="./admin_employeeprofile.php?user_id=<?=$user_id?>">Go Back</a></div> 
        <div class="">

        <h3>Assign course</h3>

<div>
<div class="row">
  <!-- Filter course by course name -->
  <div class="col">
  <form id="searchnameForm"  method="post">
  <!-- <label for="course-search">Course name</label> -->
  <input type="search" name="searchname" id="course-search" placeholder="course name">
  <input type="submit" name="filternamebtn" value="Filter">
  </form>
  </div>


  <div class="col">
  <form method="post">
  <label for="department">Department</label>
  <select name="department" id="dpartment">
  <option value=''>department</option>
  <?php  listCourseNameOption("department");?>
  </select>
  <input type="submit" name="departmentBtn" value="Filter">
</form>
  </div>

  <!-- Filter course by schedule -->
 
  <div class="col">
  <form  method="post">
  <label for="schedule">Schedule</label>
  <select name="schedule" id="schedule">
  <option value=''>schedule</option>
  <?php  listCourseNameOption("schedule");?>
  </select>
  <input type="submit" name="scheduleBtn" value="Filter">
 </div>
</div>
<div>
<span class="error"> <?php echo $inputErr;?></span>
</div>

  <?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  if (isset($_POST['filternamebtn'])) {
    echo "<script type='text/javascript'>window.location.href='#'; </script>";
    $searchInput=$_POST["searchname"];
   if($searchInput==null){
    $inputErr= "<b class='error'>Please entername!</b>";
    }else{
      $sql = "SELECT * FROM courses WHERE course_name like '%".$searchInput."%'";
      $result = $con->query($sql);
      displayCoursesAssignment($result);
      echo "<script type='text/javascript'>window.location.href='#'; </script>";
    } 
  } 
  
  if(isset($_POST['scheduleBtn'])){
    echo "<script type='text/javascript'>window.location.href='#'; </script>";
    $schedule=$_POST["schedule"];
    if( $schedule==null){
      $inputErr= "<b class='error'>Please select a schedule.</b>";}
      else{
        
        $sql = "SELECT * FROM courses WHERE schedule='".$schedule."'";
        $result = $con->query($sql);
        displayCoursesAssignment($result);
      }
  }

  if(isset($_POST['departmentBtn'])){
    $department=$_POST["department"];
    if( $department==null){
      $inputErr="<b class='error'>Please select a department.</b>";}
      else{
        $sql = "SELECT * FROM courses WHERE department='".$department."'";
        $result = $con->query($sql);
        displayCoursesAssignment($result);
      }
  }


  // Click select button to add course to enrollment;
if(isset($_POST["selectBtn"])){
  // $user_id = $_SESSION['user_id'];
  $courseIDSelected=$_POST['courseID'];
 
  // $selectedSchedule=$_POST['selectedSchedule'];
  // $sqlSceduleCheck="SELECT c.schedule
  // FROM course_enrollment e
  // INNER JOIN courses c ON e.course_id=c.course_id WHERE c.schedule='$selectedSchedule' AND e.student_id='$user_id';";
  $sqlmycourse= "SELECT *  FROM teacher_course WHERE course_id='".$courseIDSelected."' AND teacher_id='$user_id';";
  $sql_usercheck="SELECT * FROM teacher where teacher_id='$user_id'";
  $result_usercheck=$con->query($sql_usercheck);
  $result = $con->query($sqlmycourse);
  // $rs_scheduleCheck=$con->query($sqlSceduleCheck);
  if($result->fetch_assoc()>0){
    echo "<p style='color:red'><b> You have aready enrolled this course. </b></p>";
  } elseif($result_usercheck->num_rows==0){
     $inputErr="This teacher doesn't have a profile yet!";
  }
  else{
    $sqlEnroll="INSERT INTO teacher_course (teacher_id,course_id) values('".$user_id."','".$courseIDSelected."'); ";

    $result=$con->query($sqlEnroll);
    if ($result===true) {
     
       // echo "<p style='color:blue'><b> Course was successfully assigned. </b></p>";
       echo "<script type='text/javascript'>window.location.href='#'; </script>";
       $sql = "SELECT * FROM courses";
        $result = $con->query($sql);
        displayCoursesAssignment($result);
 
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
  }
}
}else{
  
  $sql = "SELECT * FROM courses";
  $result = $con->query($sql);
  displayCoursesAssignment($result);
  }
mysqli_close($con);
?>
</div>



            

        </div>
    </div>
    
</main>
</body>
</html>



