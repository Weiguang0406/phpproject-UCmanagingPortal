<?php 
//Database Connection
$course_name_err=$course_id_err=$credit_hours_err=$department_err=$teachername_err=$schedule_err="";


include('../includes/dbconnection.php');



if(isset($_POST['submit']))
  {
  	$eid=$_GET['editid'];
  	//Getting Post Values
    //getting the post values


// Need validation for duplication:
    $course_id=$_POST['course_id'];
		
    $course_name=$_POST['course_name'];
    // $teachername=$_POST['teachername'];
    $credits=$_POST['credits'];
    $schedule=$_POST['schedule'];
    $department=$_POST['department'];
		$semester=$_POST['semester'];

    //Query for data updation
     
     
			$sql_insert_course="INSERT INTO courses (course_name,course_id, semester, credit_hours, department, schedule)
      VALUES
          ( '$course_name', '$course_id', '$semester','$credits', '$department',  ' $schedule')";
				$result_insert_course=$con->query($sql_insert_course);
			if($result_insert_course){
			echo "<script>alert('You have successfully insert the course');</script>";
			echo "<script type='text/javascript'>window.location.href='./admin_allcourses.php'; </script>";
			}else{
			echo "<script>alert('Something Went Wrong. Please try again');</script>";
}
}



function listOptions($sql,$column){
	$result= $GLOBALS['con']->query($sql);
	 if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<title>Update course</title>
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
	width: 450px;
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
<div class="signup-form">
    <form  method="POST">



		<h2>AddCourse </h2>
		<p class="hint-text">Please note: Please follow the contraints.</p>
		<div class="form-group">
                <label>course_id</label>
                <input type="text" name="course_id" class="form-control <?php echo (!empty($course_id_err)) ? 'is-invalid' : ''; ?>"  >
                <span class="invalid-feedback"><?php echo $course_id_err; ?></span>
            </div> 
            <div class="form-group">
                <label>course_name</label>
                <input type="text" name="course_name" class="form-control <?php echo (!empty($course_name_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"><?php echo $course_name_err; ?></span>
            </div>
						

            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" class="form-control <?php echo (!empty($department_err)) ? 'is-invalid' : ''; ?>" >
                <span class="invalid-feedback"><?php echo $department_err; ?></span>
            </div>
            <div class="row">
							<div class="col">
							<label for="credits">Credits:</label>
  <select name="credits" id="credits">
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=3>4</option>
  </select>
	<span class="invalid-feedback"><?php echo $credits_err; ?></span>
							</div>
							<div class="col">
							<label for="schedule">Schedule:</label>
  <select name="schedule" id="schedule">
    <option value="MWF 10:00-11:30am">MWF 10:00-11:30am</option>
    <option value="TU/TH 1:00-2:30pm">TTH 1:00-2:30pm</option>
    <option value="MWF 9:00-10:30am">MWF 9:00-10:30am</option>
    <option value="MWF 2:00-3:30am">MWF 9:00-10:30am</option>
    <option value="MT 2:00-3:30am">MWF 9:00-10:30am</option>
    <option value="Tu 1:00-3:30am">MWF 9:00-10:30am</option>
  </select>
	<span class="invalid-feedback"><?php echo $schedule_err; ?></span>
							</div>

						</div>
						<div>
						<div class="row">
							<div class="col">
							<label><b>semester :</b></label>
							</div>
							<div class="col">
							<input name="semester" type="radio" value="winter" id="winter"  > <label for="winter">Winter</label>
							</div>
							<div class="col">
							<input name="semester" type="radio" value="fall" id="fall" > <label for="fall">Fall</label>
							</div>
							<div class="col">
							<input name="semester" type="radio" value="summer" id="summer"> <label for="summer">Summer</label>
							</div>
						</div>
						<span class="invalid-feedback"><?php echo $semester_err; ?></span>
						</div>      

		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Save</button>
        </div>
    </form>

</div>
</body>
</html>

