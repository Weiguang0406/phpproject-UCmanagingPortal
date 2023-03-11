<?php
// Include config file
include('../includes/dbconnection.php');
 
// Define variables and initialize with empty values
$teachername = $department =$contactnumber = $address 
= $teacheremail = $gender = "";

$teachername_err = $department_err = ""; 
$contactnumber_err = $address_err = $teacheremail_err = $gender_err 
=$teacher_id_err = "";

if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] === true)) {
    $username = $_SESSION['username'];
    $sql = "SELECT user_id FROM users WHERE username = '$username'";
    $res = mysqli_query($con, $sql);
                        
    $urow = $res->fetch_assoc();
    $user_id = $urow['user_id'];}

    $teacher_id=$user_id;
echo "<script>alert('$teacher_id');</script>";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //validate name
    if(empty(trim($_POST["teachername"]))){
        $teachername_err = "Please enter your name.";
    } elseif(!preg_match('/^[a-zA-Z ]{1,20}$/', trim($_POST["teachername"]))){
        $teachername_err = "Full name contains captial or lower case letters, space, no digit, up to 20 letters..";
    } else{
        $teachername = trim($_POST["teachername"]);
    }
     //validate email
    if (empty(trim($_POST["teacheremail"]))) {
        $teacheremail_err = "Please enter your email.";
    } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', trim($_POST["teacheremail"]))) {
        $teacheremail_err = "Invalid date of email format.";
    } else {
        $teacheremail = trim($_POST["teacheremail"]);
    }
    //validate department
    if(empty($_POST["department"])){
        $department_err = "Please select department.";     
    } 
    else{
        $department = trim($_POST["department"]);
    }
    // Validate gender
    if(empty($_POST["gender"])){
         $gender_err = "Please select gender.";     
      } 
    else{
         $gender = trim($_POST["gender"]);
        }
       //validate dob
    //can't input by teacher. should same as user_id in users table;
    if (empty(trim($_POST["teacher_id"]))) {
        $teacher_id_err = "Please enter your teacher_id.";
    } else if (!preg_match('/^[0-9]$/', trim($_POST["teacher_id"]))) {
        $teacher_id_err = "Teacher ID must same as your user_id.";
    } else {
        $teacher_id = trim($_POST["teacher_id"]);
    }
    //validate contactnumber
    if (empty(trim($_POST["contactnumber"]))) {
        $contactnumber_err = "Please enter your contactnumber.";
} else if (!preg_match('/^\d{10}$/', trim($_POST["contactnumber"]))) {
        $contactnumber_err = "Please input number.";
    } else {
        $contactnumber = trim($_POST["contactnumber"]);
    }
       //Validate address
        if (empty(trim($_POST["address"]))) {
            $address_err = "Please enter your address.";
       } elseif (!preg_match('/^\d+\s[a-zA-Z]+\s[a-zA-Z]+/', trim($_POST["address"]))) {
            $address_err = "Invalid address format.";
       } else {
             $address = trim($_POST["address"]);
       }

    // Check input errors before inserting in database
    if(empty($teacheremail_err) && empty($department_err)
    && empty($gender_err) && empty($teacher_id_err)
    && empty($contactnumber_err) && empty($address_err) && empty($teachername_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO teacher (
        teachername,
        teacheremail,
        department,
        gender,
        teacher_id,
        contactnumber,
        address) VALUES (?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $teachername, $teacheremail, $department, $gender, $teacher_id, $contactnumber,$address);      
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                // header("location: teacher_welcome.php");
                echo "<script>window.location.href='teacher_welcome.php';</script>";
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Close connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>profile register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        html,body
        { font: 14px sans-serif;
            height : 100%;
            margin: 0;
            padding: 0;
        }
        .container{
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
        }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
<h3>As a new teacher, you don't have personal profile, please complete below form.</h3>
    <div class="container">
    <div class="wrapper">
        
        <h2>Profile Register</h2>
        <p>Please fill out this form to finish your profile.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Teacher Name <span style="color: red;">*</span></label>
                <input type="text" name="teachername" class="form-control <?php echo (!empty($teachername_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $teachername; ?>">
                <span class="invalid-feedback"><?php echo $teachername_err; ?></span>
            </div>    

            <div class="form-group">
                <label>Teacher Email <span style="color: red;">*</span></label>
                <input type="text" name="teacheremail" class="form-control <?php echo (!empty($teacheremail_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $teacheremail; ?>">
                <span class="invalid-feedback"><?php echo $teacheremail_err; ?></span>
            </div>   

            <div class="form-group">
                <label>Department <span style="color: red;">*</span></label>
                <select name="department" class="form-control <?php echo (!empty($department_err)) ? 'is-invalid' : ''; ?>">
                <option value="">Please select</option>
                <option value="accounting" <?php if ($department == "accounting") echo 'selected'; ?>>Accounting</option>
                <option value="chemistry" <?php if ($department == "chemistry") echo 'selected'; ?>>Chemistry</option>
                <option value="computer science" <?php if ($department == "computer science") echo 'selected'; ?>>Computer Science</option>
                <option value="english" <?php if ($department == "english") echo 'selected'; ?>>English</option>
                <option value="communication" <?php if ($department == "telecom communication") echo 'selected'; ?>>Telecom Communication</option>
                <option value="history" <?php if ($department == "history") echo 'selected'; ?>>History</option>
            </select>
                <span class="invalid-feedback"><?php echo $department_err; ?></span>
            </div>

            <div class="form-group">
                <label>Gender <span style="color: red;">*</span></label>
                <div>
                <input type="radio" name="gender" value="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'male') ? 'checked' : ''; ?>> Male
                <input type="radio" name="gender" value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'female') ? 'checked' : ''; ?>> Female              
                </div>
                <span class="invalid-feedback"><?php echo $gender_err; ?></span>
    </br>

    <div class="form-group">
                <label>Teacher ID <span style="color: red;">*</span></label>
                <input type="text" name="teacher_id" class="form-control <?php echo (!empty($teacher_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $teacher_id; ?>">
               
            </div>
            <div class="form-group">
                <label>Contact Number <span style="color: red;">*</span></label>
                <input type="text" name="contactnumber" class="form-control <?php echo (!empty($contactnumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contactnumber; ?>">
                <span class="invalid-feedback"><?php echo $contactnumber_err; ?></span>
            </div>
 
            <div class="form-group">
                <label>Address <span style="color: red;">*</span></label>
                <input type="text" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">
                <span class="invalid-feedback"><?php echo $address_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
           
        </form>
    </div>   
    </div> 
</body>
</html>