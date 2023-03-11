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
        echo "SQL=>" . $sql;
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo "<script>alert('Your username or password is wrong');</script>";
        } else if (mysqli_num_rows($result) == 1) {
            echo "<script> alert('login success!');</script>";
                session_start();
                $_SESSION['loggedin'] = 1;
                $_SESSION['username'] = $username;
              //  echo "<script> alert('kkkkkkkkkkkk!');</script>";
                echo "<script>location.href='student_welcome.php';</script>";
            }else {
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
<div class="container">
    <div class="intro">
        <h2>Portal Intruduction</h2></br>
        <p>Welcome to our course registration management portal for instructors!
            Our platform is designed to simplify the process of managing course rosters,
            providing instructors with a user-friendly and efficient tool for monitoring
            student enrollment and progress.</p>
        <h2>Features</h2></br>
        <p>Our portal offers a range of features to support instructors throughout the
            course registration process, including: </p>
        <ul>
            <li>Course roster: Our platform provides instructors with instant access to
                their course rosters, allowing them to monitor student enrollment and track
                progress throughout the semester.</li>
            <li>Grade management: Our platform also supports the management of student grades,
                providing instructors with tools for entering and calculating grades, and
                communicating feedback to students.</li>
            <li>Student information: Once an instructor has selected a student, they can access
                detailed information about the student, including their contact information. </li>
            <li>Personal profile management</li>
        </ul>
        <p>Please feel free to browse around and contact us if you have any questions.</p>

    </div>
</div>
</body>
</html>
