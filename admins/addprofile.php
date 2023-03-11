<?php
// Check if the user is logged in and if has the right priviledge, otherwise redirect to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true|| $_SESSION["roles"]!=="admin"){
//     header("location: login.php");
//     exit;
// }
include('../includes/dbconnection.php');

$log_error = array();
function duplicateusername($username, $con)
{
    include('../includes/dbconnection.php');
    $query = "SELECT (username)  FROM users where username='$username';";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 0) {
        return 0;
    } else {
        return 1;
    }

}

/*$log_error['studentname'] = $log_error['username'] = $log_error['password'] = $log_error['confirmpassword'] = "";
$log_error['studentemail'] = $log_error['gender'] = $log_error['dob'] = $log_error['studentid'] = "";
$log_error['fathername'] = $log_error['mothername'] = $log_error['contactnumber'] = "";
$log_error['alternatenumber'] = $log_error['address'] = $log_error['imagefilename'] = $log_error['dateofadmission'] = "";

*/
$studentname = $username = $password = $confirmpassword = "";
$studentemail = $gender = $dob = "";
$fathername = $mothername = $contactnumber = "";
$alternatenumber = $address = $imagefilename = $dateofadmission = "";
$login_err = "";
if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['submit']))) {
//getting the post values
    // echo "<script>alert('Method=POST');</script>";

    $studentname = $_POST['studentname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $studentemail = $_POST['studentemail'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];


    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $contactnumber = $_POST['contactnumber'];
    $alternatenumber = $_POST['alternatenumber'];
    $address = $_POST['address'];
    //$imagefilename = $_POST['imagefilename'];
    $dateofadmission = $_POST['dateofadmission'];
    // echo "<script>alert('get POST VALUE : ');</script>";
    // echo "<script>alert('$dateofadmission');</script>";
    //echo "<script>alert('$username');</script>";
    //echo "<script>alert('$password');</script>";

    if (empty(trim($_POST["studentname"]))) {
        $log_error['studentname'] = "Please enter studentname";
    } elseif (!preg_match('/^[a-zA-Z0-9]{1,20}$/', trim($_POST["studentname"]))) {
        $log_error['studentname'] = "Captial or lower case, letter only, one space, no digit, up to 20 letters.";
    } else {
        $studentname = trim($_POST["studentname"]);
    }


    if (empty(trim($_POST["username"]))) {
        $log_error['username'] = "Please enter username";
    } elseif (!preg_match('/^[a-zA-Z0-9]{1,20}$/', trim($_POST["username"]))) {
        $log_error['username'] = "Captial or lower case, letter only, one space, no digit, up to 20 letters";
    } elseif (duplicateusername($username, $con)) {
        $log_error['username'] = "Someone else use this usename, please change another one";
    } else {
        $username = trim($_POST["username"]);
    }


    if (empty(trim($_POST["password"]))) {
        $log_error['password'] = "Please enter password";
    } elseif (!preg_match('/^[a-zA-Z0-9]{6,}$/', trim($_POST["password"]))) {
        $log_error['password'] =  "Captial or lower case, letter,digit.at least 6";
    } else {
        $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    }


    if (empty(trim($_POST["confirmpassword"]))) {
        $log_error['confirmpassword'] = "Please enter confirmpassword";
    } elseif (!preg_match('/^[a-zA-Z0-9]{6,}$/', trim($_POST["confirmpassword"]))) {
        $log_error['confirmpassword'] =  "Captial or lower case, letter,digit.at least 6";
    } else {
        $confirmpassword = trim($_POST["confirmpassword"]);
    }


    if (empty(trim($_POST["studentemail"]))) {
        $log_error['studentemail'] = "Please enter studentemail";
    } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', trim($_POST["studentemail"]))) {
        $log_error['studentemail'] = "Please input correct Email address";
    } else {
        $studentemail = trim($_POST["studentemail"]);
    }


    if (empty(trim($_POST["gender"]))) {
        $log_error['gender'] = "Please enter gender";
    } elseif ($gender !== 'female' && $gender !== 'male') {
        $log_error['gender'] = "Please input right gender";
    } else {
        $gender = trim($_POST["gender"]);
    }


    if (empty(trim($_POST["dob"]))) {
        $log_error['dob'] = "Please enter dob";
    } elseif (!preg_match('/^(19|20)\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/', trim($_POST["dob"]))) {
        $log_error['dob'] = "Please input YYYY--MM-DD";
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



    if (!empty(trim($_POST["address"])) && !preg_match('/^\d+\s+[a-zA-Z0-9\s]+(Ave|road|street|avenue|drive|boulevard|way|court|crescent|circle|lane|parkway|place|square|trail|^$)\s*$/', trim($_POST["address"]))) {
        $log_error['address'] = "Please input right address, for example:1113 Brant Ave";
    } else {
        $address = trim($_POST["address"]);
    }


//check if upload file name  exists.
    if (empty($_FILES["image"]["name"])) {
        $log_error['image'] = "Please upload your photo with .jpg file name extension";
    } else {
        $image = $_FILES["image"]["name"];
    }
    $temp = $_POST["dateofadmission"];

    if (empty(trim($_POST["dateofadmission"]))) {
        $log_error['dateofadmission'] = "Please enter data of admission";
    } else {
        $dateofadmission = trim($_POST["dateofadmission"]);
    }

    // echo "<script>alert('insert data22222');</script>";

    if (empty($log_error)) {
        // echo "<script>alert('empty_log_error');</script>";
        //  echo "<script>alert('$username');</script>";
        //  echo "<script>alert('$dob');</script>";
        //   echo "<script>alert('insert data3333333333333');</script>";
        $sql = "SELECT MAX(CAST(user_id AS UNSIGNED)) AS max_user_id FROM users;";
        //  $sql = "select  MAX(CAST(user_id))as max_user_id from users;";
        $query = mysqli_query($con, $sql);

        $row = array();
        if ($query) {
            $row = $query->fetch_assoc();
        }
        $temp = $row['max_user_id'];
        // echo "<script>alert('$temp');</script>";
        $user_id = strval($row['max_user_id'] + 1);
        // echo "<script>alert('user->'+'$user_id');</script>";
        $sql = "insert into users(user_id,username,password,roles) 
values('$user_id','$username', '$password', 'student')";
        $query = mysqli_query($con, $sql);
        // echo "<script>alert('$'student'+'user_id');</script>";
        $sql = "insert into students(student_id,  studentname,studentemail, gender, dob,fathername, mothername, 
            contactnumber, alternatenumber, address,  imagefilename,dateofadmission) 
            values('$user_id', '$studentname','$studentemail', '$gender', '$dob','$fathername', '$mothername', 
            '$contactnumber', '$alternatenumber', '$address',   '$imagefilename','$dateofadmission'                                                                                              
            )";

        $query = mysqli_query($con, $sql);


        if ($query) {
            echo "<script>alert('Add a user profile successfully!! ');</script>";

            //add photo


     //       echo "<script>alert('Handle photo')</script>";
            if (isset($_FILES["image"])) {
                $uploads_dir = "../uploads/";
                $temp = $_FILES["image"]["name"];
       //         echo "<script>alert('FIlename'+'$temp')</script>";
                $target_file = $uploads_dir . basename($_FILES["image"]["name"]);
         //       echo "<script>alert('$target_file')</script>";

                $uploadOk = 1;
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
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }

                // limit file size
                if ($_FILES["image"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // what's kind of file can be used in this code
                /*   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                       && $imageFileType != "gif" ) {
                       echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                       $uploadOk = 0;
                   }
*/
                // what's kind of file can be used in this code
                if ($imageFileType != "jpg") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }


                // if no errors move file to demp directory
                if ($uploadOk == 1) {
                    $new_file_name = $user_id . '.jpg';
           //         echo "<script>alert('from this file'+'$target_file')</script>";
           //         echo "<script>alert('copy to  '+'$new_file_name')</script>";
                    //rename file name to '$userid'.jpg
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploads_dir . $new_file_name)) {
//                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

           //           echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
            echo "<script type='text/javascript'>window.location.href='./admin_student_list.php'; </script>";

        } else {
            echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }
    } else {
        //echo "<script>alert('insert data5555555555555');</script>";
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
                    <form method="POST" enctype="multipart/form-data">
                        <table border="1" class=" table table-bordered mg-b-0">
                            <tr align="center" class="table-warning">
                                <td colspan="4" style="font-size:20px;color:blue">
                                    Students Details
                                </td>
                            </tr>

                            <tr class="table-info">
                                <th><label for="studentname"> Student Name <span class="text-danger">*</span></label>
                                </th>
                                <td>
                                    <input type="text" name="studentname"
                                           class="form-control <?php echo (!empty($log_error['studentname'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $studentname; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['studentname']; ?></span>
                                </td>


                                <th><label for="username"> User Name <span class="text-danger">*</span></label></th>
                                <td>
                                    <input type="text" name="username"
                                           class="form-control <?php echo (!empty($log_error['username'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $username; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['username']; ?></span>
                                </td>

                            </tr>

                            <tr class="table-info">
                                <th><label for="password"> Password <span class="text-danger">*</span></label></th>
                                <td>
                                    <input type="password" name="password"
                                           class="form-control <?php echo (!empty($log_error['password'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $password; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['password']; ?></span>
                                </td>


                                <th><label for="confirmpassword"> Confirmation Password <span
                                                class="text-danger">*</span></label></th>
                                <td>
                                    <input type="password" name="confirmpassword"
                                           class="form-control <?php echo (!empty($log_error['confirmpassword'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $confirmpassword; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['confirmpassword']; ?></span>
                                </td>

                            </tr>

                            <tr class="table-info">
                                <th><label for="studentemail"> Student Email <span class="text-danger">*</span></label>
                                </th>
                                <td>
                                    <input type="text" name="studentemail"
                                           class="form-control <?php echo (!empty($log_error['studentemail'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $studentemail; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['studentemail']; ?></span>
                                </td>


                                <th><label for="gender"> Gender <span class="text-danger">*</span></label></th>
                                <td>
                                    <!--         <input type="text" name="gender"
                                           class="form-control <?php echo (!empty($log_error['gender'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $gender; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['gender']; ?></span>
-->

                                    <label for="male">Male</label>
                                    <input type="radio" id="male" name="gender" value="male" checked>

                                    <label for="female">Female</label>
                                    <input type="radio" id="female" name="gender" value="female">
                                </td>

                            </tr>


                            <tr class="table-info">

                                <th><label for="dob">Date of Birth <span class="text-danger">*</span></label></th>
                                <td><input type="date" id="dob" name="dob" max="2013-02-28"
                                           class="form-control <?php echo (!empty($log_error['dob'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $dob; ?>" required>
                                    <span class="invalid-feedback"><?php echo $log_error['dob']; ?></span>


                                </td>
                                <th><label for="fathername"> Father Name </label></th>
                                <td>
                                    <input type="text" name="fathername"
                                           class="form-control <?php echo (!empty($log_error['fathername'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $fathername; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['fathername']; ?></span>
                                </td>

                            </tr>
                            <tr class="table-info">

                                <th><label for="mothername">Mother Name </label></th>
                                <td>
                                    <input type="text" name="mothername"
                                           class="form-control <?php echo (!empty($log_error['mothername'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $mothername; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['mothername']; ?></span>
                                </td>

                                <th><label for="contactnumber"> Contact Number </label></th>
                                <td>
                                    <input type="text" name="contactnumber"
                                           class="form-control <?php echo (!empty($log_error['contactnumber'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $contactnumber; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['contactnumber']; ?></span>
                                </td>
                            </tr>


                            <tr class="table-info">
                                <th><label for="alternatenumber"> Alternate Number</label></th>
                                <td>
                                    <input type="text" name="alternatenumber"
                                           class="form-control <?php echo (!empty($log_error['alternatenumber'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $alternatenumber; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['alternatenumber']; ?></span>
                                </td>
                                <th><label for="adress"> Address </label></th>
                                <td>
                                    <input type="text" name="address"
                                           class="form-control <?php echo (!empty($log_error['address'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $address; ?>">
                                    <span class="invalid-feedback"><?php echo $log_error['address']; ?></span>
                                </td>
                            </tr>

                            <tr class="table-info">


                                <th><label for="image">Image File Name </label></th>
                                <td>
                                    <input type="file" name="image"

                                           class="form-control <?php echo (!empty($log_error['image'])) ? 'is-invalid' : ''; ?>"
                                           value="">
                                    <span class="invalid-feedback"><?php echo $log_error['image']; ?></span>
                                </td>


                                </td>


                                <th><label for="dateofadmission">Date of Admission <span
                                                class="text-danger">*</span></label></th>
                                <td><input type="date" id="dateofadmission" name="dateofadmission"
                                           class="form-control <?php echo (!empty($log_error['dateofadmission'])) ? 'is-invalid' : ''; ?>"
                                           value="<?php echo $dateofadmission; ?>" required>

                                    <span class="invalid-feedback"><?php echo $log_error['dateofadmission']; ?></span>
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
</body>
</html>