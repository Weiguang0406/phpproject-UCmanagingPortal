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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Employee</title>
</head>
<style>
  .btn-group{
    margin-left: 3%;
    position: fixed;
  }
  .btn-group a{
    border:none;
    /* font-size: 20px; */
  }
  .btn-group button{
    border:none;
    /* font-size: 20px; */
  }
  .main{
    margin-top: 120px;
  }
</style>
<body>
<?php include('../header.php'); ?>
<?php include('adminnavbar.php'); ?>
  <main class="main">
  
  

<?php include('employeeProfilePage.php'); ?>

  </main>
<?php include('../footer.php'); ?>
</body>
</html>