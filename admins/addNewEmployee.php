<?php 
//Database Connection
$user_id=$username=$password=$roles=$teacher_id=$teachername=$teacheremail=$department=$gender=$contactnumber=$address="";

$user_id_err=$username_err=$password_err=$roles_err=$teachername_err=$teacheremail_err=$department_err=$gender_err=$contactnumber_err=$address_err="";
include('../includes/dbconnection.php');



if(isset($_POST['save']))
  {
		// $sql_check_id="select * from users where user_id='".$_POST["user_id"]."'";
		// $sql_check_username="select * from users where username='".$_POST["username"]."'";
    	//Getting Post Values
    //getting the post values
		if(empty(trim($_POST["user_id"]))){
			$user_id_err="User_id is required";
		}elseif(!preg_match('/^[\d]{1,20}$/', ($_POST["user_id"]))){
      $user_id_err = "user_id should be numbers";
  } else{
      // Prepare a select statement
      $sql = "SELECT user_id FROM users WHERE user_id = ?";
      
      if($stmt = mysqli_prepare($con, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "s", $param_user_id);
          
          // Set parameters
          $param_user_id = trim($_POST["user_id"]);
          
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              /* store result */
              mysqli_stmt_store_result($stmt);
              
              if(mysqli_stmt_num_rows($stmt) == 1){
                  $user_id_err = "This user_id is already taken.";
              } else{
                  $user_id = trim($_POST["user_id"]);
              }
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }

          // Close statement
          mysqli_stmt_close($stmt);
      }
  }
  

	

// Validate username
if(empty(trim($_POST["username"]))){
	$username_err = "Please enter a username.";
} elseif(!preg_match('/^[A-Za-z][A-Za-z0-9]{1,19}$/', trim($_POST["username"]))){
	$username_err = "username only allow lowercase letter and numbers";
} else{
	// Prepare a select statement
	$sql = "SELECT username FROM users WHERE username = ?";
	
	if($stmt = mysqli_prepare($con, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			
			// Set parameters
			$param_username = trim($_POST["username"]);
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
					/* store result */
					mysqli_stmt_store_result($stmt);
					
					if(mysqli_stmt_num_rows($stmt) == 1){
							$username_err = "This username is already taken.";
					} else{
							$username = trim($_POST["username"]);
					}
			} else{
					echo "Oops! Something went wrong. Please try again later.";
			}

			// Close statement
			mysqli_stmt_close($stmt);
	}
}



    // $user_id=$_POST['user_id'];
		// $teacher_id=$_POST['user_id'];
    // $username=$_POST['username'];

		if(empty(trim($_POST["teachername"]))){
			$teachername_err = "Please enter a teachername.";
		}else{
			$teachername=$_POST['teachername'];
		}
   

// Validate teacheremail
if(empty(trim($_POST["teacheremail"]))){
	$teacheremail_err = "Please enter a teacheremail.";
} elseif(!preg_match("/^[\w\.\-]+@[\w\.\-]+\.[a-zA-Z]{2,4}$/", trim($_POST["teacheremail"]))){
	$teacheremail_err = "Error: Invalid email address. Please enter a valid email address.";
} else{
	// Prepare a select statement
	$sql = "SELECT teacheremail FROM teacher WHERE teacheremail = ?";
	
	if($stmt = mysqli_prepare($con, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_teacheremail);
			
			// Set parameters
			$param_teacheremail = trim($_POST["teacheremail"]);
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
					/* store result */
					mysqli_stmt_store_result($stmt);
					
					if(mysqli_stmt_num_rows($stmt) == 1){
							$teacheremail_err = "This teacheremail is already taken.";
					} else{
							$teacheremail = trim($_POST["teacheremail"]);
					}
			} else{
					echo "Oops! Something went wrong. Please try again later.";
			}

			// Close statement
			mysqli_stmt_close($stmt);
	}
}


		// $teacheremail=$_POST['teacheremail'];

		if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter new password.";
	} else{
			// Validate password format
			$pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/';
			if (!preg_match($pattern, trim($_POST["password"]))) {
					$password_err = "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.";
			}else{

				$password=password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
			}
	}
   
	    $roles=$_POST['roles'];
		if(empty($_POST['department'])){
			$department='';
		}else{
			$department=$_POST['department'];
		}
   
		if(empty($_POST['gender'])){
			$gender='';
		}else{
			$gender=$_POST['gender'];
		}

		if (!empty(trim($_POST["contactnumber"])) && !preg_match('/^\d{10}$/', trim($_POST["contactnumber"]))) {
			$contactnumber_err = "Please input letter and digit without special characters, max 15 chars";
	} else {
			$contactnumber = trim($_POST["contactnumber"]);
	}

	if (!empty(trim($_POST["address"])) && !preg_match('/^\d+\s[a-zA-Z]+\s[a-zA-Z]+/', trim($_POST["address"]))) {
			$contactnumber_err = "Please input letter and digit without special characters, max 15 chars";
	} else {
			$address = trim($_POST["address"]);
	}
	


    //Query for data updation
     
    if(empty($user_id_err)&&empty($username_err)&&empty($password_err)&&empty($roles_err)&&empty($teachername_err)&&empty($teacheremail_err)&&empty($department_err)&&empty($gender_err)&&empty($contactnumber_err)&&empty($address_err)){
/* Start transaction */
      

$con->begin_transaction();

try{

	// $sql_insert_users="INSERT INTO users(user_id,username, password,roles)
	// VALUES('$user_id', '$username','$password','$roles')";
	
	$stmt = $con->prepare('INSERT INTO users(user_id,username, password,roles)
	VALUES(?, ?,?,?)');
			$stmt->bind_param('ssss', $user_id,  $username, $password,$roles );
			
			if($stmt->execute()){
				// $sql_insert_employee="INSERT INTO teacher(teacher_id, teachername, teacheremail,department,gender,contactnumber,address) 
				// VALUES('$user_id', '$teachername','$teacheremail','$department','$gender','$contactnumber','$address');";
	
	
		 $stmt2 = $con->prepare('INSERT INTO teacher(teacher_id, teachername, teacheremail,department,gender,contactnumber,address) 
			VALUES(?, ?,?,?,?,?,?);');
				$stmt2->bind_param('sssssss', $user_id,  $teachername, $teacheremail,$department, $gender,$contactnumber, $address);
				$stmt2->execute();
	
				/* If code reaches this point without errors then commit the data in the database */
				$con->commit();
				echo "<script>alert('The user is successfully added！');</script>";
				echo "<script type='text/javascript'>window.location.href='./admin_users.php'; </script>";
			}else{
				echo "<script>alert('Something Went Wrong. Please try again');</script>";
			};
		
}catch (mysqli_sql_exception $exception) {
	$con->rollback();

	throw $exception;
	echo "<script>alert('Something Went Wrong. Please try again');</script>";
}

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
    echo "<option value='No department Available'>No Course Available</option>";
  }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<title>Add Employee</title>
<style>
body {
	color: #fff;
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	height: 40px;
	box-shadow: none;
	color: #969fa4;
}
.form-control:focus {
	border-color: #5cb85c;
}
.form-control, .btn {        
	border-radius: 3px;
}
.signup-form {
	width: 600px;
	margin: 0 auto;
	padding: 30px 0;
  	font-size: 15px;
}
.signup-form h2 {
	color: #636363;
	margin: 0 0 15px;
	position: relative;
	text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
	content: "";
	height: 2px;
	width: 30%;
	background: #d4d4d4;
	position: absolute;
	top: 50%;
	z-index: 2;
}	
.signup-form h2:before {
	left: 0;
}
.signup-form h2:after {
	right: 0;
}
.signup-form .hint-text {
	color: #999;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {
	color: black;
	
	border-radius: 3px;
	margin-bottom: 15px;
	background: #f2f3f7;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
	margin-top: 3px;
}
.signup-form .btn {        
	font-size: 16px;
	font-weight: bold;		
	min-width: 140px;
	outline: none !important;
}
.signup-form .row div:first-child {
	padding-right: 10px;
}
.signup-form .row div:last-child {
	padding-left: 10px;
}    	
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5cb85c;
	text-decoration: none;
}	
.signup-form form a:hover {
	text-decoration: underline;
}  
</style>
</head>
<body>
<?php include('../header.php'); ?>
<?php include('adminnavbar.php'); ?>
	<main>
<div class="signup-form">
<h2>Add new user </h2>
		<p class="hint-text">Please note: .................</p>
    <form  method="POST">
<!-- row -->
			<div class="row">
				<div class="form-group col">
                <label>user_id</label>
                <input type="text" name="user_id" class="form-control <?php echo (!empty($user_id_err)) ? 'is-invalid' : ''; ?>" required >
                <span class="invalid-feedback"><?php echo $user_id_err; ?></span>
            </div> 
            <div class="form-group col">
                <label>username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" required>
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
			</div>
<!-- row -->
<div class="row">
				<div class="form-group col">
                <label>password</label>
                <input type="text" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"  required >
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div> 
						<div class="col">
							<label for="roles">Role:</label>
  <select name="roles" id="roles">
    <option value="admin">admin</option>
    <option value="teacher">teacher</option>
  </select>
	<span class="invalid-feedback"><?php echo $roles_err; ?></span>
							</div>
			</div>

			<div class="row">
			<div class="form-group col">
                <label>Employee Name</label>
                <input type="text" name="teachername" class="form-control <?php echo (!empty($teachername_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"><?php echo $teachername_err; ?></span>
            </div>
			<div class="form-group col">
                <label>Employee Email</label>
                <input type="text" name="teacheremail" class="form-control <?php echo (!empty($teacheremail_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"><?php echo $teacheremail_err; ?></span>
            </div>
			</div>
			
			<div class="row">
						<div class="form-group col">
                <label>Department</label>
								<select name="department" id="dpartment">
    <?php  listCourseNameOption("department");?>
  </select>
                <span class="invalid-feedback"><?php echo $department_err; ?></span>
            </div>
						<div class="form-group col">
                <label>Contact Number</label>
                <input  type="tel" name="contactnumber"  class="form-control <?php echo (!empty($contactnumber_err)) ? 'is-invalid' : ''; ?>" >
                <small>Format: 1234567890</small>
								<span class="invalid-feedback"><?php echo $contactnumber_err; ?></span>
            </div>
			</div>
      <div class="row">
						<div class="form-group col">
                <label>Address</label>
                <input type="text" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"><?php echo $address_err; ?></span>
            </div>
			</div>     
   					<div>
						<div class="row">
							<div class="col">
							<label><b>Gender :</b></label>
							</div>
							<div class="col">
							<input name="gender" type="radio" value="male" id="male"  > <label for="male">Male</label>
							</div>
							<div class="col">
							<input name="gender" type="radio" value="female" id="female" > <label for="female">Female</label>
							</div>
							<div class="col">
							<input name="gender" type="radio" value="nonbinary" id="nonbinary"> <label for="nonbinary">Non-binary</label>
							</div>
						</div>
						<span class="invalid-feedback"><?php echo $gender_err; ?></span>
						</div>      

		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg " name="save">Save</button>
						<button type="rest" class="btn btn-danger btn-lg " onclick="window.location.href='./admin_users.php'" name="cancel">Cancel</button>
        </div>
    </form>

</div>
</body>
</main>
</html>

