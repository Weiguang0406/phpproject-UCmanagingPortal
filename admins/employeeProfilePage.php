<?php

// Connect database;
include('../includes/dbconnection.php');


$username=$teachername=$teacheremail=$department=$gender=$contactnumber=$address=$roles="";
$inputErr="";

if(isset($_GET['user_id'])){
  $user_id=$_GET['user_id'];
  if(!empty($user_id)){

    $sql="select * from users c left join teacher t on c.user_id=t.teacher_id where user_id =".$user_id;
$result=$con->query($sql);

if($result){
  $row=$result->fetch_assoc();

  $username=$row['username'];
  $teachername=$row['teachername'];
  $teacheremail=$row['teacheremail'];
  $department=$row['department'];
  $gender=$row['gender'];
  $contactnumber=$row['contactnumber'];
  $address=$row['address'];
  $roles=$row['roles'];
}
  }else
  echo "<b>Something is wrong please try it again!</b>"; 
}

// Function
function displayCoursesAssignment($result){
  if ($result->num_rows > 0) {
    $teacher_id= $GLOBALS['user_id'];
    echo "<table class='table'><tr><th>#</th><th>Course Name</th><th>Course ID</th><th>Hours</th><th>Department</th><th>Semester</th><th>Schedule</th><th> </th></tr>";
    // output data of each row
   $row_no=1;
   while($row = $result->fetch_assoc()) {
     
     $rowClass= $row_no%2==1?"table-primary":"table-progress";
     $id=$row['id'];
     $btnRemove= ' <input type="text" name="courseID" id="" style="display:none" value="'.$id.'">
     <input type="submit" name="removeBtn" class="btn btn-primary" value="Remove">';

    //  $btnRemove='<a href="?user_id='.$teacher_id.'?cid='.$row['course_id'].'">Unassign</i></a>';
     
    
     // $btnDel= '<button type="submit" name="delid" value="'.$row['course_id'].'" onclick="return confirm(\'Do you really want to Delete ?\');"><i class="material-icons">&#xE872;</i></button>';
    
     echo "<tr class=$rowClass ><td>"
      .$row_no."</td><td>"
      .$row["course_name"]."</td><td>"
      .$row["course_id"]."</td><td>"
      .$row["credit_hours"]."</td><td>"
      .$row["department"]."</td><td>"
      .$row["semester"]."</td><td>"
      .$row["schedule"]."</td><td><form action ='#' method='post'>"
      .$btnRemove."</form></td></tr>";
      $row_no++;
   }
   echo "</table>";
 } else {
   echo "No records found!";
 }
}
// Function2:
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

if(isset($_POST['savepassword'])){
  
  $newPwd=$_POST['newpwd'];
$sql="UPDATE users set password='$newPwd' WHERE user_id='$user_id'";

if($con->query($sql)){
  echo "<script>alert('Password reset succeeded.')</script>";
}else
echo "<script>alert('Something wrong please try it again.')</script>";
}




// Remove course from enrollment;
if(isset($_POST["removeBtn"])){
  
  $courseToRemove=$_POST['courseID'];
  $sql = 'DELETE FROM teacher_course WHERE id="'.$courseToRemove.'";';

if ($con->query($sql) === TRUE) {
  echo "<script>alert(One Course was removed from '$username' successfully)</script>";
} else {
  echo "Error deleting record: " . $con->error;
}
}
?>


  <style>
  
  /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  /* padding-top: 200px; / */
  left: 30%;
  top: 150px;
  width: 50%; 
  height: auto; /* Full height */
  overflow: auto; 
  /* background-color: rgb(0,0,0); Fallback color */
  /* background-color: rgba(0,0,0,0.4); Black w/ opacity */
}


/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  width: 20px;
  font-size: 28px;
  font-weight: bold;
  margin-left: 95%;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

</style>

  <div class="btn-group" role="group">
  <a href="./admin_users.php"  class="btn btn-outline-primary">Go Back</a> 
  <a href="editEmployeeProfile.php?user_id=<?=$user_id?>" class="btn btn-outline-primary">Edit Properties</a>
  <button onclick='window.location.reload(true)' class="btn btn-outline-primary">Refresh</button>
  <button class="btn btn-outline-primary" id="resetbtn">Reset Password</button>
</div>
<hr>

<div id="outerbox">
<div id="basic info">
<h4>Employee Info</h4>
<br>
<div class="row">
  <div class="col-2">
  <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="120">
  </div>
<div class="col-10">
<div class="mt-3">
                      <h3><?php echo $username ?> </h3>
                      <p class="text-secondary mb-1"><?php echo $teacheremail ?> </p>
                      <p class="text-muted font-size-md"><?php echo strtoupper($roles) ?> </p>
</div>
</div>
</div >
</div>
<br>
<!-- Properties -->
<div id="profile" class="font">
<div class="row">
<div class="col-sm-2"><h6 class="mb-0">Email</h6></div>
<div class="col-sm-9 text-secondary"> <?php echo $teacheremail ?></div>
</div>

<div class="row">
<div class="col-sm-2"> <h6 class="mb-0">ID</h6> </div>
<div class="col-sm-10 ">  <?php echo $user_id ?> </div>
</div>
<div class="row">
<div class="col-sm-2"> <h6 class="mb-0">Department</h6> </div>
<div class="col-sm-10 ">  <?php echo $department ?> </div>
</div>
<div class="row">
<div class="col-sm-2"> <h6 class="mb-0">Gneder</h6> </div>
<div class="col-sm-10 ">  <?php echo $gender ?> </div>
</div>
<div class="row">
<div class="col-sm-2"> <h6 class="mb-0">Contact</h6> </div>
<div class="col-sm-10 ">  <?php echo $contactnumber ?> </div>
</div>
<div class="row">
<div class="col-sm-2"> <h6 class="mb-0">Address</h6> </div>
<div class="col-sm-10 ">  <?php echo $address ?> </div>
</div>
</div>
<br>
<hr>

<div id="courses">
<h4>Courses Assigned</h4>
<?php


if(!empty($user_id)){
  $sql="SELECT * from teacher_course tc join courses c on tc.course_id=c.course_id where teacher_id=".$user_id;
  $result = $con->query($sql);
  if($result){
    displayCoursesAssignment($result);
  }else{
    echo "Can not find any result!";
  }
}else{
  echo "Something wrong, please try it again or contact your admin!";
}


?>
<br>
<div>
<a href='adminAssignCourse.php?user_id=<?php echo $user_id?>' class="btn btn-primary" > Assign course </a>
</div>


</div>
</div>

<!-- Password reset Modal -->

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>
    <?php echo strtoupper($username) ?>
      </h3>
<form action="" method="post">
      <div class=" row">

              <div class="col-8"> <label>Reset Password</label>
                <input type="text" name="newpwd" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"><?php echo $log_error['password']; ?></span></div>
                    
                </div>
                <div class="col-2 mt-3"><button type="submit" name="savepassword"> Save</button></div>

      </div>
      </form>
  </div>

</div>

<?php

if(isset($_POST['savepassword'])){
  $user_id=$_GET['user_id'];

  if (empty(trim($_POST["newpwd"]))) {
    $password_err = "Please enter new password.";
} else{
    // Validate password format
    $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/';
    if (!preg_match($pattern, trim($_POST["newpwd"]))) {
        $password_err = "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.";
    }else{

      $password=password_hash(trim($_POST["newpwd"]), PASSWORD_DEFAULT);
    }
}


if(empty($password_err)){

$sql="UPDATE users SET password ='$password' WHERE user_id='$user_id'";

$result = mysqli_query($con, $sql);
if ($result === false) {
  echo "<script>alert('Error updating'+'mysqli_error($con)');</script>";

} else
  echo "<script>alert('Password changed');</script>";

}



}


?>



<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("resetbtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>



