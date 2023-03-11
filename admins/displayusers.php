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

// // Get Student ID;Student Page
// $queryStudentID=$con->query("SELECT student_id FROM students WHERE username ='".$_SESSION ['username']."'");
// $row=$queryStudentID->fetch_assoc();
// $_SESSION['studentID']=$row['student_id'];

// $studentID = $_SESSION['studentID'];

$inputErr=$scheduleErr="";

function displayUsers($result){
   if ($result->num_rows > 0) {
   
    echo "<table class='table'><tr><th>#</th><th>userame</th><th>User ID</th><th>Role</th><th>Full Name</th><th>Email</th><th>gender</th><th>Status</th><th> </th></tr>";
    // output data of each row
    $row_no=1;
    while($row = $result->fetch_assoc()) {
      
      $rowClass= $row_no%2==1?"table-primary":"table-progress";
      // $id=$row['course_id'];
      $btnEdit= '<a href="editEmployeeProfile.php?user_id='.$row['user_id'].'"><i class="material-icons">&#xE254;</i></a>';
      $btnDel= '<a href="?delid='.$row['user_id'].'" onclick="return confirm(\'Do you really want to Delete ?\');"><i class="material-icons">&#xE872;</i></a>';
     
     
      // $btnDel= '<button type="submit" name="delid" value="'.$row['course_id'].'" onclick="return confirm(\'Do you really want to Delete ?\');"><i class="material-icons">&#xE872;</i></button>';
      $href="admin_employeeprofile.php?user_id=".$row['user_id'];

      echo "<tr class=$rowClass ><td>"
      .$row_no."</td><td><a href='$href' >".$row["username"]."</a><td>"
      .$row["user_id"]."</td><td>"
      .$row["roles"]."</td><td>"
      .$row["teachername"]."</td><td>"
      .$row["teacheremail"]."</td><td>"
      .$row["gender"]."</td><td></td><td><form method='post'>"
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

include('adminDeleteEmployee.php');

 
?>

<div>
<div class="row">
  <!-- Filter course by course name -->
  <div class="col">
  <form id="searchnameForm"  method="post">
  <label for="user-search">Search username</label>
  <input type="search" name="searchname" id="user-search" placeholder="username or name">
  <input type="submit" name="filternamebtn" value="Filter">
  </form>
  </div>

  <!-- Filter course by schedule -->
  <div class="col">
  <form id="searchEmailForm"  method="post">
  <label for="user-search2">Search email</label>
  <input type="search" name="searchemail" id="user-search2" placeholder="email">
  <input type="submit" name="filteremailbtn" value="Filter">
  </form>
  </div>
</div>
<div>
<span class="error"> <?php echo $inputErr;?></span>
</div>
<br><br>
<div>
<?php
// Display filtered courses PHP;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  if (isset($_POST['filternamebtn'])) {
    $searchInput=$_POST["searchname"];
   if($searchInput==null){
    $inputErr= "<b class='error'>Please entername!</b>";
    }else{
      $sql = "SELECT * from users c join teacher t on c.user_id=t.teacher_id WHERE username like '%".$searchInput."%'";
      $result = $con->query($sql);
      displayUsers($result);
    } 
  } 
  
  if(isset($_POST['filteremailbtn'])){
    $searchInput=$_POST["searchemail"];
    if( $searchInput==null){
      echo "<b class='error'>Please enter an email.</b>";}
      else{
        $sql = "SELECT * from users c join teacher t on c.user_id=t.teacher_id WHERE email like '%".$searchInput."%'";
        $result = $con->query($sql);
        displayUsers($result);
      }
  }

}else{
  
$sql = "SELECT * from users c join teacher t on c.user_id=t.teacher_id order by username";
$result = $con->query($sql);
displayUsers($result);
}

mysqli_close($con);
?>
</div>


