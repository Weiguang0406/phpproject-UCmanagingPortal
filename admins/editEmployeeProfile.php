<?php
// Connect database;
include('../includes/dbconnection.php');


$username=$teachername=$teacheremail=$department=$gender=$contactnumber=$address=$roles=$teacher_id="";
$inputErr="";
$username_Err=$teachername_Err=$teacheremail_Err=$department_Err=$gender_Err=$contactnumber_Err=$address_Err=$roles_Err="";

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])){



// if(isset($_GET['user_id']))
//   {
  	$user_id=$_GET['user_id'];
    
      $teachername = $_POST['teachername'];
      $gender = $_POST['gender'];
    //   $teacher_id=$_POST['teacher_id'];
      $contactnumber = $_POST['contactnumber'];
      $address = $_POST['address'];
      $department = $_POST['department'];
      $teacheremail = $_POST['teacheremail'];
     // echo "<script>alert('$username');</script>";
      //     echo "<script>alert('$password');</script>";
  
  
      if (empty(trim($_POST["teachername"]))) {
          $log_error['teachername'] = "Please enter teachername";
      } elseif (!preg_match('/^[a-zA-Z ]{1,20}$/', trim($_POST["teachername"]))) {
          $log_error['teachername'] = "Please input letter and digit without special characters, max 15 chars";
      } else {
          $teachername = trim($_POST["teachername"]);
      }
  
  
      if (empty(trim($_POST["teacheremail"]))) {
          $log_error['teacheremail'] = "Please enter teacheremail";
      } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', trim($_POST["teacheremail"]))) {
          $log_error['teacheremail'] = "Please input letter and digit without special characters, max 15 chars";
      } else {
          $teacheremail = trim($_POST["teacheremail"]);
      }
  
      // Validate gender
      if(empty($_POST["gender"])){
          $gender_err = "Please select gender.";     
       } 
     else{
          $gender = trim($_POST["gender"]);
         }
  
      if(empty($_POST["department"])){
          $department_err = "Please select department.";     
      } 
      else{
          $department = trim($_POST["department"]);
      }
  
      if (!empty(trim($_POST["contactnumber"])) && !preg_match('/^\d{10}$/', trim($_POST["contactnumber"]))) {
          $log_error['contactnumber'] = "Please input letter and digit without special characters, max 15 chars";
      } else {
          $contactnumber = trim($_POST["contactnumber"]);
      }
  
      if (!empty(trim($_POST["address"])) && !preg_match('/^\d+\s[a-zA-Z]+\s[a-zA-Z]+/', trim($_POST["address"]))) {
          $log_error['address'] = "Please input letter and digit without special characters, max 15 chars";
      } else {
          $address = trim($_POST["address"]);
      }
  
     // echo "<script>alert('44444444444444444444444444')</script>";
      if (empty($log_error)) {
   
          $sql = "update teacher set teachername='$teachername'
                              ,teacheremail='$teacheremail'
                              ,gender='$gender'
                              ,contactnumber='$contactnumber'
                              ,department='$department'
                              ,address='$address'
                          where teacher_id='$user_id'";
  
          $query = mysqli_query($con, $sql);
  
        //  echo "<script>alert('update students...777777777777777777777776');</script>";
          if ($query) {
              // echo "<script>alert('User profile saved successfully');</script>";
             // header("location: admin_student_list.php");
             echo "<script>window.location.href='./admin_employeeprofile.php?user_id=$user_id';</script>";
              exit();
          } else {
              echo "<script>alert('Something Went Wrong. Please try again');</script>";
          }
      }
}



function listOptions($sql,$column){
	$result= $GLOBALS['con']->query($sql);
	 if ($result->num_rows > 0) {
		while($row = $result_teacher->fetch_assoc()) {
		echo "<option value='".$row["$column"]."'>".$row["$column"]."</option>";
	 }
 } else {
	 echo "<option value='No teacher Available'>No teacher Available</option>";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Document</title>
</head>
<style>
.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>
<body>
  
<?php
$user_id=$_GET['user_id'];
$ret=$con->query("SELECT * from users c join teacher t on c.user_id=t.teacher_id WHERE user_id='$user_id'");

while ($row=$ret->fetch_assoc()) {
?>
<form action="" method="post">
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://bootdey.com/img/Content/avatar/avatar7.png"><span class="font-weight-bold"><?php echo $row['username']; ?></span><span class="text-black-50"><?php echo $row['teacheremail']; ?></span><span> </span></div>
        </div>
        <div class="col-md-6 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label>Employee Name</label>
                <input type="text" name="teachername" class="form-control <?php echo (!empty($teachername_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $row['teachername']; ?>"  >
                <span class="invalid-feedback"><?php echo $log_error['teachername']; ?></span></div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label>Employee Email</label>
                <input type="text" name="teacheremail" class="form-control <?php echo (!empty($teacheremail_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $row['teacheremail']; ?>" >
                <span class="invalid-feedback"><?php echo $log_error['teacheremail']; ?></span></div>
                </div>
                <div class="row mt-3">
                <div class="col-md-12"><label>Department</label>
                <select name="department" id="dpartment">
  <option value="<?php echo $row['department']; ?>"><?php echo $row['department']; ?></option>
  <?php  listCourseNameOption("department");?>
  </select>
                <span class="invalid-feedback"><?php echo $department_err; ?></span></div>
                  
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label>Contact Number</label>
                <input  type="tel" name="contactnumber" pattern="[0-9]{10}" class="form-control <?php echo (!empty($contactnumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $row['contactnumber']; ?>">
                <small>Format: 1234567890</small>
								<span class="invalid-feedback"><?php echo $log_error['contactnumber']; ?></span>
                            </div>
                    </div>


                <div class="row mt-3">
                    <div class="col-md-12"> <label>Address</label>
                <input type="text" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $row['address']; ?>" >
                <span class="invalid-feedback"><?php echo $log_error['address']; ?></span></div>
                    
                </div>

                <div class="row mt-3">
            
                     </div>

                <div class="row mt-3">
							<div class="col ">
							<label><b>Gender :</b></label>
							</div>
							<div class="col">
							<input name="gender" type="radio" value="male" id="male" <?php echo $row['gender']=='male'? 'checked':''; ?> > <label for="male">Male</label>
							</div>
							<div class="col">
							<input name="gender" type="radio" value="female" id="female" <?php echo $row['gender']=='female'? 'checked':''; ?> > <label for="female">Female</label>
							</div>
							<div class="col">
							<input name="gender" type="radio" value="nonbinary" id="nonbinary" <?php echo $row['gender']=='nonbinary'? 'checked':''; ?> > <label for="nonbinary">Non-binary</label>
							</div>
              <span class="invalid-feedback"><?php echo $gender_err; ?></span>
						</div>
						

                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit" name="submit">Save Profile</button>
                <a type="submit" class="btn btn-danger " onclick="window.location.href='./admin_employeeprofile.php?user_id=<?=$user_id?>'" name="cancel">Cancel</a>
            </div>
               
            </div>
        </div>
        <?php }
?>
    </div>
</div>
</div>
</form>
</div>
</body>
</html>

