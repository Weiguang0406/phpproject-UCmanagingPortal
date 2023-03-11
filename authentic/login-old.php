<?php

//Databse Connection file
include('../includes/dbconnection.php');
//Init data

$username = $password = "";
$username_err = $password_err = "";
$keep_me_signed_in = "";

if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['submit']))) {


//getting the post values
//  $username=$_POST['username'];
//  $password=$_POST['password'];
//  $confirm_password=$_POST['confirm_password'];


//validation input data

//validation username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter password.";
    } else {
        $password = trim($_POST["password"]);
    }


    if ((empty($username_err)) && (empty($password_err))) {
        $sql = "select * from users where username='$username' and password='$password'";
        //echo "SQL=>" . $sql;
        $result = mysqli_query($con, $sql);
        $row=$result->fetch_assoc();

        if (mysqli_num_rows($result) == 0) {
            echo "<script>alert('Your username or password is wrong');</script>";
        } else if (mysqli_num_rows($result) == 1) {
            echo "<script> alert('login success!');</script>";
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] =$row['user_id'];
            $_SESSION['roles'] = $row['roles'];
            $page= $row['roles']."s/".$row['roles'].'_welcome.php';
            //  echo "<script> alert('kkkkkkkkkkkk!');</script>";
            echo "<script>location.href='../$page';</script>";
        } else {
            echo "<script>alert('System Error');</script>";
            //echo "<script type='text/javascript'> document.location ='index.php'; </script>";
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
    <title>User Login</title>
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
    <form method="POST">
        <h1 class="text-center">Log in </h1>
        <div class="form-group">
            <div class="row">
                <label for="username"> User Name :</label>
                <input type="text" name="username"
                       class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                       value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>

            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label for="password"> Password :</label>
                <input type="password" name="password"
                       class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                       value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
        </div>

        <div class="form-group ">
            <div class="row">
                <button type="submit" class="btn btn-success btn-lg btn-block " name="submit">Submit</button>
            </div>
        </div>

        <div class="form-group ">
            <div class="row">
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <label class="form-check-label text-muted">
                            <input type="checkbox" id="remember" class="form-check-input" name="remember" checked/> Keep
                            me signed in </label>
                    </div>
                    <a href="student_forgot_password.php" class="auth-link text-black">Forgot password?</a>
                </div>
            </div>


            <div class="form-group ">
                <div class="row">
                    <a class="btn btn-warning btn-lg btn-block" href="../index.html">Back Home</a>


                </div>
            </div>
        </div>

    </form>

</div>
</body>
</html>
