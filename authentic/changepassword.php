<?php

//Databse Connection file
include('../includes/dbconnection.php');

// function validation_password($header_username,$person){
//     include '../includes/dbconnection.php';
//  //   echo "<script>alert('Validation_password in...')</script>";
//  //   echo "<script>alert('header_username...')</script>";
//  //   echo "<script>alert('$header_username')</script>";
//   //  echo "<script>alert('password...')</script>";
//   //  echo "<script>alert('$password')</script>";
//  //   echo "<script>alert('person...')</script>";
//  //   echo "<script>alert('$person')</script>";
//     $sql="select password as old_password from users where username='$header_username' ";
//     $result = mysqli_query($con, $sql);
//     $row=null;
//     if ($result){
//         $row=$result->fetch_assoc();
//         if(password_verify($person, $_POST['old_password']))
//             return true;
//         else return false;
//     }else {
//         echo "SYStem ERROR!";
//     }
// }
//Init data
if (empty($header_username)) {
    echo "<script>alert('You are not signed in, please siged in first')</script>";
    header("location:../index.html");

} else {
    $old_password = $new_password = $confirm_password = "";
    $old_password_err = $new_password_err = $confirm_password_err = "";
    $keep_me_signed_in = "";
//echo "<script> alert('11111111111111111111111')</script>";
//$u1 = $_SERVER["REQUEST_METHOD"];
//$u2 = $_POST['submit'];
//echo "<script> alert('action=>'+$u1)</script>";
//echo "<script> alert('submit'+$u2)</script>";


    if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['submit']))) {

    
        //$u1 = $_SERVER["REQUEST_METHOD"];
        $u2 = $_POST['old_password'];

       
        //validation username
        if (empty(trim($_POST["old_password"]))) {
            $old_password_err = "Please enter old_password";
        } else {
            $sql="select password as old_password from users where username='$header_username' ";
            $result = mysqli_query($con, $sql);
            $row=$result->fetch_assoc();
            $hash_password=$row['old_password'];
            if(!password_verify($_POST['old_password'], $hash_password)){
                $old_password_err = "!!!!Your old password is not right";
            } 
            // else
            //     $old_password = trim($_POST["old_password"]);
    
        }
        
        

        if (empty(trim($_POST["new_password"]))) {
            $new_password_err = "Please enter new_password.";
        } else {
            $new_password = trim($_POST["new_password"]);
        }

        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please enter confirm_password.";
        } else if (trim($_POST["confirm_password"]) != trim($_POST["new_password"])) {
            $confirm_password_err = "Please enter the same password with above";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
        }

        if ((empty($old_password_err)) && (empty($new_password_err)) && (empty($confirm_password_err))) {
            $username = $_SESSION['username'];
            $roles = $_SESSION['roles'];

            $new_password =password_hash(trim($_POST["new_password"]), PASSWORD_DEFAULT);
            //echo "<script> alert('jjjj'+'$username')</script>";
            //  $sql = "update users set password = $new_password where username='$username'";
            $sql = "update users set password = '$new_password' where username='$username'";


            //echo "SQL=>" . $sql;
            $result = mysqli_query($con, $sql);
            if ($result === false) {
                echo "<script>alert('Error updating'+'mysqli_error($con)');</script>";

            } else
                echo "<script>alert('Password changed');</script>";

            switch ($roles) {
                case 'teacher':
                    //header("location:teacher_login.php");
                    echo "<script>window.location.href='../index.html'</script>";

                    break;
                case 'student':
                  //  header("location:student_login.php");
                    echo "<script>window.location.href='../index.html'</script>";

                    break;
                case 'admin':
                    echo "<script>window.location.href='../index.html'</script>";

                   // header("location:admin_login.php");
                    break;
            }

        }

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
            background: #fff;
            font-family: 'Roboto', sans-serif;
            padding: 5px;
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
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h1 class="text-center">Change Password </h1>
        <div class="form-group">
            <div class="row">
                <label for="old_password"> Password :</label>
                <input type="password" name="old_password"
                       class="form-control <?php echo (!empty($old_password_err)) ? 'is-invalid' : ''; ?>"
                       value="<?php echo $old_password; ?>">
                <span class="invalid-feedback"><?php echo $old_password_err; ?></span>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label>New Password</label>
                <input type="password" name="new_password"
                       class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>"
                       value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>

            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password"
                       class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
        </div>


        <div class="form-group">
            <div class="row">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <a class="btn btn-link btn-warning " href="#">Cancel</a>
            </div>
        </div>

    </form>
</div>
</body>
</html>