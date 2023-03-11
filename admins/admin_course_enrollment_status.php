<?php
session_start();
// Check if the user is logged in and if has the right priviledge, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true|| $_SESSION["roles"]!=="admin"){
    header("location: admin_login.php");
    exit;
}

// ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Enrollment Status</title>
</head>
<body>
<?php include('../header.php'); ?>
<?php include('adminnavbar.php'); ?>
  <main>
  <div class="bg-pink m-3 ">
        <h2 class="m-3">Course Management </h2>
        <h3 class="m-3">Enrollment status</h3>
        <hr>
        <?php include('course_enrollment_status.php'); ?>

    </div>

  </main>
<?php include('../footer.php'); ?>
</body>
</html>