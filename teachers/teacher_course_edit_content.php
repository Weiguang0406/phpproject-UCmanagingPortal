<?php 
//Database Connection
include('../includes/dbconnection.php');
if(isset($_POST['submit']))
  {
  	$course_id=$_GET['course_id'];
  	// Getting Post Values
    $course_name=$_POST['course_name'];
    $credit_hours=$_POST['credit_hours'];
    $department=$_POST['department'];
    $semester=$_POST['semester'];
    $schedule=$_POST['schedule'];

    //Query for data updation
     $query=mysqli_query($con, "update courses set 
	 credit_hours ='$credit_hours', 
	 schedule='$schedule' 
	 where course_id='$course_id'");
      
	 //course_name ='$course_name', 
	 //department='$department', 
	 //  semester='$semester', 

	 if ($query) {
		echo "<script>alert('You have successfully update the data');</script>";
		echo "<script type='text/javascript'> document.location ='teacher_coursemanage.php'; </script>";
	  }
	  else
		{
		  echo "<script>alert('Something Went Wrong. Please try again');</script>";
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>PHP Crud Operation!!</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #fff;
	/* background: #63738a; */
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
	color: #999;
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
 <?php
$eid=$_GET['course_id'];
$ret=mysqli_query($con,"select * from courses where course_id='$eid'");
while ($row=mysqli_fetch_array($ret)) {
?>
		<h2>Edit</h2>
		<p class="hint-text">You can only change column in Red color</p>
        <div class="form-group">
        </div>

		<div class="form-group"><span>Course ID : <?php  echo $row['course_id'];?></span>
        </div>

		<div class="form-group"><span style="color: red;">Credit Hours :</span>
    	<select class="form-control" name="credit_hours" id="credit_hours">
        <option value="1" <?php if($row['credit_hours'] == '1') echo 'selected="selected"'; ?>>1</option>
        <option value="2" <?php if($row['credit_hours'] == '2') echo 'selected="selected"'; ?>>2</option>
        <option value="3" <?php if($row['credit_hours'] == '3') echo 'selected="selected"'; ?>>3</option>
        <option value="4" <?php if($row['credit_hours'] == '4') echo 'selected="selected"'; ?>>4</option>
   		 </select>
		</div>

        <div class="form-group">Course Name :</span>
    	<input type="text" class="form-control" name="course_name" value="<?php echo $row['course_name'];?>" readonly>
		</div>
		<div class="form-group">Department :</span>
    	<input type="text" class="form-control" name="department" value="<?php echo $row['department'];?>" readonly>
		</div>
		<div class="form-group">Semester :</span>
    	<input type="text" class="form-control" name="semester" value="<?php echo $row['semester'];?>" readonly>
		</div>
		
		<div class="form-group">
  		<label for="schedule" style="color: red;">Schedule:</label>
  		<select class="form-control" id="schedule" name="schedule">
   		<option value="MWF 10:00-11:30am" <?php if($row['schedule'] == 'MWF 10:00-11:30am') echo 'selected="selected"'; ?>>MWF 10:00-11:30am</option>
  		<option value="TTH 1:00-2:30pm" <?php if($row['schedule'] == 'TTH 1:00-2:30pm') echo 'selected="selected"'; ?>>TTH 1:00-2:30pm</option>
    	<option value="MWF 9:00-10:30am" <?php if($row['schedule'] == 'MWF 9:00-10:30am') echo 'selected="selected"'; ?>>MWF 9:00-10:30am</option>
  		</select>
		</div>
      <?php 
}?>
		<div class="form-group">
            <button type="text" class="btn btn-success btn-lg btn-block" name="submit">Edit</button>
        </div>
    </form>

</div>
</body>
</html>