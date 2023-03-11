<?php
include('../includes/dbconnection.php');
$log_error = array();
$log_error = null;
// echo "<script>alert('beginning11111111111111111')</script>";

$teachername = $teacher_id = "";
$teacheremail = $gender ="";
$department = $contactnumber = "";
$address = "";
$login_err = "";
$oldrow = array();
//getting the post values
//    echo "<script>alert('Method=POST');</script>";
//$temp = $_GET['user_id'];
//   echo "<script>alert($temp)</script>";

//echo "<script>alert('111111111111111111111111111111');</script>";
//get display data from database
if (!empty($_GET['user_id'])) {
   // echo "<script>alert('getuseridget data from db for display2222222222222222222222')</script>";
    //get data from database
    $user_id = $_GET['user_id'];
    $teacher_id =$user_id;
    $sql = "select teacher_id, teachername, teacheremail, department, contactnumber, address, gender
             from teacher t
            inner join users u on t.teacher_id=u.user_id 
           where teacher_id='$user_id'";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo "Query error: " . mysqli_error($con);
    } else if (mysqli_num_rows($result) > 1) {
        echo "System Error";
    } else if (mysqli_num_rows($result) === 1) {

        $oldrow = $result->fetch_assoc();
        // $oldrow['confirmpassword'] = $oldrow['password'];
        //     $temp = $oldrow['username'];
        //      echo "<script>alert($temp)</script>";
    }
}
//echo "<script>alert('22222222222222222222222222222.555555555555555555');</script>";
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) {
 //   echo "<script>alert('Post method get 3333333333333333333333333')</script>";
  //  echo "<script>alert('user_id ==>'+'$user_id')</script>";

    $teachername = $_POST['teachername'];
    $gender = $_POST['gender'];
    $teacher_id=$_POST['teacher_id'];
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
           echo "<script>window.location.href='teacher_welcome.php';</script>";
            exit();
        } else {
            echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System|| View Teacher Profile</title>
    <link rel="stylesheet" href="	https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css">
    <link rel="stylesheet"
          href="	https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/event-drops/1.3.0/style.css"/>
</head>
<body>
<div class="signup-form">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] . '?user_id=' . $user_id ?>">
                        <table border="1" class=" table table-bordered mg-b-0">
                            <tr align="center" class="table-warning">
                                <td colspan="4" style="font-size:20px;color:blue">
                                    Teacher Details
                                </td>
                            </tr>

                            <tr class="table-info">
                                <th><label for="studentname"> Teacher Name <span class="text-danger">*</span></label>
                                </th>
                                <td>
                                    <!--<?php echo $teachername; ?>
                                    <?php echo empty($log_error['teachername']) ? "" : $log_error['teachername']; ?>
                                    <?php echo $oldrow['teachername']; ?>  -->
                                    <input type="text" name="teachername"
                                           class="form-control <?php echo (!empty($log_error['teachername'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $teachername ? $teachername : $oldrow['teachername']; ?>">
                                    <span class="invalid-feedback"><?php echo empty($log_error['teachername']) ? "" : $log_error['teachername']; ?></span>
                                </td>
                                </tr>
                                <tr class="table-info">

                                <th><label for="username"> Teacher Email <span class="text-danger">*</span></label></th>
                                <td>
                                    <input type="text" name="teacheremail"
                                           class="form-control <?php echo (!empty($log_error['teacheremail'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $teacheremail ? $teacheremail : $oldrow['teacheremail']; ?>">
                                    <span class="invalid-feedback"><?php echo empty($log_error['teacheremail']) ? "" : $log_error['teacheremail']; ?></span>
                                </td>

                            </tr>
                            <tr class="table-info">
                                <th><label for="user_id"> Teacher ID <span class="text-danger">*</span></label>
                                </th>
                                <td> <?php  echo $oldrow['teacher_id'];?> </td>
                            </tr>
                         
                            <tr class="table-info">
                            <th>
                            <label>Gender <span style="color: red;">*</span></label>
                            </th>
                            <td>
                            <input type="radio" name="gender" value="male" <?php echo ((isset($_POST['gender']) && $_POST['gender'] == 'male') || $oldrow['gender'] == 'male') ? 'checked' : ''; ?>> Male
                            <input type="radio" name="gender" value="female" <?php echo ((isset($_POST['gender']) && $_POST['gender'] == 'female') || $oldrow['gender'] == 'female') ? 'checked' : ''; ?>> Female
                            </td>
                            </tr>

                            <tr class="table-info">
                            <th><label>Department <span style="color: red;">*</span></label></th>
                            <td>
                            <select name="department" class="form-control <?php echo (!empty($department_err)) ? 'is-invalid' : ''; ?>">
                             <option value="">Please select</option>
                             <option value="accounting" <?php if ($oldrow['department'] == "accounting") echo 'selected'; ?>>Accounting</option>
                             <option value="chemistry" <?php if ($oldrow['department'] == "chemistry") echo 'selected'; ?>>Chemistry</option>
                             <option value="computer science" <?php if ($oldrow['department'] == "computer science") echo 'selected'; ?>>Computer Science</option>
                             <option value="english" <?php if ($oldrow['department'] == "english") echo 'selected'; ?>>English</option>
                             <option value="telecom communication" <?php if ($oldrow['department'] == "telecom communication") echo 'selected'; ?>>Telecom Communication</option>
                             <option value="history" <?php if ($oldrow['department'] == "history") echo 'selected'; ?>>History</option>
                            </select>
                            </td>
                            </tr>

                            </tr>
                            <tr class="table-info">                           

                                <th><label for="contactnumber"> Contact Number </label></th>
                                <td>
                                    <input type="text" name="contactnumber"
                                           class="form-control <?php echo (!empty($log_error['contactnumber'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $contactnumber ? $contactnumber : $oldrow['contactnumber']; ?>">

                                    <span class="invalid-feedback"><?php echo empty($log_error['contactnumber']) ? "" : $log_error['contactnumber']; ?></span>
                                </td>
                            </tr>

                            <tr class="table-info">
                                <th><label for="adress"> Address </label></th>
                                <td>
                                    <input type="text" name="address"
                                           class="form-control <?php echo (!empty($log_error['address'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $address ? $address : $oldrow['address']; ?>">

                                    <span class="invalid-feedback"><?php echo empty($log_error['address']) ? "" : $log_error['address']; ?></span>
                                </td>
                            </tr>
                            <tr class="table-info">

                        </table>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-success btn-lg btn-block " name="submit">Save</button>
                            <!-- <button type="submit" class="btn btn-danger btn-lg btn-block " name="cancel">Cancel</button> -->

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>