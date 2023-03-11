<?php
include('../includes/dbconnection.php');
$log_error = array();
$log_error = null;
//echo "<script>alert('beginning11111111111111111')</script>";

$studentname = $username = $password = $confirmpassword = "";
$studentemail = $gender = $dob = "";
$fathername = $mothername = $contactnumber = "";
$alternatenumber = $address = $imagefilename = $dateofadmission = "";
$login_err = "";
$oldrow = array();
if (!empty($_GET['user_id'])) {
    //get data from database
    $user_id = $_GET['user_id'];
    $sql = "select s.student_id, studentname, studentemail, studentclass, gender, dob,fathername, mothername, 
            contactnumber, alternatenumber, address, u.username, u.password, imagefilename,dateofadmission
             from students s
            inner join users u on s.student_id=u.user_id 
           where student_id='$user_id'";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo "Query error: " . mysqli_error($con);
    } else if (mysqli_num_rows($result) > 1) {
        echo "System Error";
    } else if (mysqli_num_rows($result) === 1) {

        $oldrow = $result->fetch_assoc();
        $oldrow['confirmpassword'] = $oldrow['password'];
        $old_gender=$oldrow['gender'];
        //     $temp = $oldrow['username'];
        //      echo "<script>alert($temp)</script>";
    }
}
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $studentemail = $_POST['studentemail'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $student_id = $oldrow['student_id'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $contactnumber = $_POST['contactnumber'];
    $alternatenumber = $_POST['alternatenumber'];
    $address = $_POST['address'];
    $dateofadmission = $_POST['dateofadmission'];

    //validation input
    if (empty(trim($_POST["username"]))) {
        $log_error['username'] = "Please enter username";
    } elseif (!preg_match('/^[a-zA-Z0-9]{1,20}$/', trim($_POST["username"]))) {
        $log_error['username'] = "Captial or lower case, letter only, one space, no digit, up to 20 letters";
    } else {
        $username = trim($_POST["username"]);
    }


    if (empty(trim($_POST["password"]))) {
        $log_error['password'] = "Please enter password";
    } elseif (!preg_match('/^[a-zA-Z0-9]{6,}$/', trim($_POST["password"]))) {
        $log_error['password'] = "Captial or lower case, letter,digit.at least 6";
    } else {
        $password = trim($_POST["password"]);
    }


    if (empty(trim($_POST["confirmpassword"]))) {
        $log_error['confirmpassword'] = "Please enter confirmpassword";
    } elseif (!preg_match('/^[a-zA-Z0-9]{6,}$/', trim($_POST["confirmpassword"]))) {
        $log_error['confirmpassword'] = "Captial or lower case, letter,digit.at least 6";
    } else {
        $confirmpassword = trim($_POST["confirmpassword"]);
    }


    if (empty(trim($_POST["studentemail"]))) {
        $log_error['studentemail'] = "Please enter studentemail";
    } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i', trim($_POST["studentemail"]))) {
        $log_error['studentemail'] = "Please input right Email address";
    } else {
        $studentemail = trim($_POST["studentemail"]);
    }


    if (empty(trim($_POST["gender"]))) {
        $log_error['gender'] = "Please enter gender";
    } elseif (!preg_match('/^[a-zA-Z][a-zA-Z0-9]{0,14}$/', trim($_POST["gender"]))) {
        $log_error['gender'] = "Please input letter and digit without special characters, max 15 chars";
    } else {
        $gender = trim($_POST["gender"]);
    }


    if (empty(trim($_POST["dob"]))) {
        $log_error['dob'] = "Please enter dob";
    } else {
        $dob = trim($_POST["dob"]);
    }


    if (!empty(trim($_POST["fathername"])) && !preg_match('/^[a-zA-Z ]{1,20}$/', trim($_POST["fathername"]))) {
        $log_error['fathername'] = "Captial or lower case, letter only, one space, no digit, up to 20 letters.";
    } else {
        $fathername = trim($_POST["fathername"]);
    }


    if (!empty(trim($_POST["mothername"])) && !preg_match('/^[a-zA-Z ]{1,20}$/', trim($_POST["mothername"]))) {
        $log_error['mothername'] = "Captial or lower case, letter only, one space, no digit, up to 20 letters.";
    } else {
        $mothername = trim($_POST["mothername"]);
    }


    if (!empty(trim($_POST["contactnumber"])) && !preg_match('/^[0-9]{10}$/', trim($_POST["contactnumber"]))) {
        $log_error['contactnumber'] = "Please input 10 digitals only";
    } else {
        $contactnumber = trim($_POST["contactnumber"]);
    }


    if (!empty(trim($_POST["alternatenumber"])) && !preg_match('/^[0-9]{10}$/', trim($_POST["alternatenumber"]))) {
        $log_error['alternatenumber'] = "Please input 10 digitals only";
    } else {
        $alternatenumber = trim($_POST["alternatenumber"]);
    }


    if (!empty(trim($_POST["address"])) && !preg_match('/^\d+\s+[a-zA-Z0-9\s]+(Ave|road|street|avenue|drive|boulevard|way|court|crescent|circle|lane|parkway|place|square|trail)\s*$/', trim($_POST["address"]))) {
        $log_error['address'] = "Please input right address, for example:1113 Brant Ave";
    } else {
        $address = trim($_POST["address"]);
    } if (empty(trim($_POST["dateofadmission"])))  {
        $log_error['dateofadmission'] = "Please input correct date";
    } else {
        $dateofadmission = trim($_POST["dateofadmission"]);
    }

    if (empty($log_error)) {
        $sql = "update  users set username='$username',
                  password='$password',roles='student'
                              where user_id='$user_id'";
        $query = mysqli_query($con, $sql);
        if ($query) {
         //   echo "<script>alert('User table  saved successfully');</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }
        $sql = "update students set 
                            studentemail='$studentemail'
                            ,gender='$gender'
                            , dob='$dob'
                            ,fathername='$fathername'
                            ,mothername='$mothername'
                            ,contactnumber='$contactnumber'
                            ,dateofadmission='$dateofadmission'
                            ,alternatenumber='$alternatenumber'
                            ,address='$address'
                            ,imagefilename='$imagefilename'
                        where student_id='$user_id'";

        $query = mysqli_query($con, $sql);
        if ($query) {
       //     echo "<script>alert('User profile saved successfully');</script>";
       //     echo "<script>alert('Handle photo')</script>";
            if (isset($_FILES["image"])) {
                $uploads_dir = "../uploads/";
                $temp = $_FILES["image"]["name"];
        //        echo "<script>alert('FIlename'+'$temp')</script>";
                $target_file = $uploads_dir . basename($_FILES["image"]["name"]);
        //        echo "<script>alert('$target_file')</script>";
              //  $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // To check if file is img
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }

                //to check if upload file  exists
                if (file_exists($target_file)) {
                    $fullpath=$uploads_dir . $target_file;
                    unlink($fullpath);
                    echo "<script>'Sorry, file already exists.'</script>";
                    $uploadOk = 1;
                }

                // limit file size
                if ($_FILES["image"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // what's kind of file can be used in this code
                if ($imageFileType != "jpg") {
                    echo "Sorry, only JPG files are allowed.";
                    $uploadOk = 0;
                }

                // if no errors move file to demp directory
                if ($uploadOk == 1) {
                    $new_file_name = $user_id . '.jpg';
                   // echo "<script>alert('from this file'+'$target_file')</script>";
                   // echo "<script>alert('copy to  '+'$new_file_name')</script>";
                    //rename file name to '$userid'.jpg
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploads_dir . $new_file_name)) {
                    //    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
            echo "<script>window.location.href='student_profile.php'</script>";
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
    <title>Student Management System|| View Students Profile</title>
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
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] . '?user_id=' . $user_id ?>"
                          enctype="multipart/form-data">
                        <table border="1" class=" table table-bordered mg-b-0">
                            <tr align="center" class="table-warning">
                                <td colspan="4" style="font-size:20px;color:blue">
                                    Students Details
                                </td>
                            </tr>
                            <tr class="table-info">
                                <th><label for="studentname"> Student Name <span class="text-danger">*</span></label>
                                </th>

                                <td><?php echo $oldrow['studentname']; ?></td>

                                <th><label for="dateofadmission"> Date of Admission <span
                                                class="text-danger">*</span></label></th>

                                <td><input type="date" id="dateofadmission" name="dateofadmission"
                                           class="form-control <?php echo (!empty($log_error['dateofadmission'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $dateofadmission ? $dateofadmission : $oldrow['dateofadmission']; ?>"
                                           required>
                                <span class="invalid-feedback"><?php echo $log_error['dateofadmission']; ?></span>


                                </td>

                            </tr>
                            <tr class="table-info">
                                <th><label for="user_id"> Student ID <span class="text-danger">*</span></label>
                                </th>
                                <td>
                                    <?php echo $oldrow['student_id'] ?>
                                </td>
                                <th><label for="username"> User Name <span class="text-danger">*</span></label></th>
                                <td>
                                    <input type="text" name="username"
                                           class="form-control <?php echo (!empty($log_error['username'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $username ? $username : $oldrow['username']; ?>">
                                    <span class="invalid-feedback"><?php echo empty($log_error['username']) ? "" : $log_error['username']; ?></span>
                                </td>
                            </tr>
                            <tr class="table-info" hidden>
                                <th><label for="password"> Student Password <span class="text-danger">*</span></label>
                                </th>
                                <td>
                                    <input type="text" name="password" hidden
                                           class="form-control <?php echo (!empty($log_error['password'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $password ? $password : $oldrow['password']; ?>">
                                    <span class="invalid-feedback"><?php echo empty($log_error['password']) ? "" : $log_error['password']; ?></span>
                                </td>
                                <th><label for="confirmpassword"> confirmpassword <span
                                                class="text-danger">*</span></label></th>
                                <td>
                                    <input type="text" name="confirmpassword" hidden
                                           class="form-control <?php echo (!empty($log_error['confirmpassword'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $confirmpassword ? $confirmpassword : $oldrow['confirmpassword']; ?>">
                                    <span class="invalid-feedback"><?php echo empty($log_error['confirmpassword']) ? "" : $log_error['confirmpassword']; ?></span>
                                </td>

                            </tr>
                            <tr class="table-info">
                                <th><label for="studentemail"> Student Email <span class="text-danger">*</span></label>
                                </th>
                                <td>
                                    <input type="text" name="studentemail"
                                           class="form-control <?php echo (!empty($log_error['studentemail'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $studentemail ? $studentemail : $oldrow['studentemail']; ?>">
                                    <span class="invalid-feedback"><?php echo empty($log_error['studentemail']) ? "" : $log_error['studentemail']; ?></span>
                                </td>
                                <th><label for="gender"> Gender <span class="text-danger">*</span></label></th>
                                <td>

                                    <input type="radio" name="gender" value="male" <?php if($old_gender == 'male') echo 'checked'; ?>> Male
                                    <input type="radio" name="gender" value="female" <?php if($old_gender == 'female') echo 'checked'; ?>> Female


                            </tr>
                            <tr class="table-info">
                                <th><label for="dob"> Date of Birth <span class="text-danger">*</span></label></th>

                                <td><input type="date" id="dob" name="dob" max="2013-02-28"
                                           class="form-control <?php echo (!empty($log_error['dob'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $dob ? $dob : $oldrow['dob']; ?>" required>
                                    <span class="invalid-feedback"><?php echo $log_error['dob']; ?></span>
                                </td>
                                <th><label for="fathername"> Father Name </label></th>
                                <td>
                                    <input type="text" name="fathername"
                                           class="form-control <?php echo (!empty($log_error['fathername'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $fathername ? $fathername : $oldrow['fathername']; ?>">
                                    <span class="invalid-feedback"><?php echo empty($log_error['fathername']) ? "" : $log_error['fathername']; ?></span>
                                </td>
                            </tr>
                            <tr class="table-info">

                                <th><label for="mothername">Mother Name </label></th>
                                <td>
                                    <input type="text" name="mothername"
                                           class="form-control <?php echo (!empty($log_error['mothername'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $mothername ? $mothername : $oldrow['mothername']; ?>">

                                    <span class="invalid-feedback"><?php echo empty($log_error['mothername']) ? "" : $log_error['mothername']; ?></span>
                                </td>

                                <th><label for="contactnumber"> Contact Number </label></th>
                                <td>
                                    <input type="text" name="contactnumber"
                                           class="form-control <?php echo (!empty($log_error['contactnumber'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $contactnumber ? $contactnumber : $oldrow['contactnumber']; ?>">

                                    <span class="invalid-feedback"><?php echo empty($log_error['contactnumber']) ? "" : $log_error['contactnumber']; ?></span>
                                </td>
                            </tr>


                            <tr class="table-info">


                                <th><label for="alternatenumber"> Alternate Number</label></th>
                                <td>
                                    <input type="text" name="alternatenumber"
                                           class="form-control <?php echo (!empty($log_error['alternatenumber'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $alternatenumber ? $alternatenumber : $oldrow['alternatenumber']; ?>">

                                    <span class="invalid-feedback"><?php echo empty($log_error['alternatenumber']) ? "" : $log_error['alternatenumber']; ?></span>
                                </td>
                                <th><label for="adress"> Address </label></th>
                                <td>
                                    <input type="text" name="address"
                                           class="form-control <?php echo (!empty($log_error['address'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $address ? $address : $oldrow['address']; ?>">

                                    <span class="invalid-feedback"><?php echo empty($log_error['address']) ? "" : $log_error['address']; ?></span>
                                </td>
                            </tr>
                        </table>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-success btn-lg btn-block " name="submit">Save
                            </button>
                            <button type="submit" class="btn btn-danger btn-lg btn-block " name="cancel">Cancel</button>
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