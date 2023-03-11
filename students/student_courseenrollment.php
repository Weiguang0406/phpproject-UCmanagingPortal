<?php
// Session info
// session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Home</title>
</head>
<?php $currentPage = 'student_portal'; ?>
<style>
 html{
    background-color:#f2f2f2;
  }
  .error{
    color:red;
  }

</style>
<body>
<?php include('../header.php'); ?>
<?php include('studentnavbar.php'); ?>
<!-- Main Content -->
<main>
  <div class="bg-pink m-3 ">
    <h2 class="text-center">Register course</h2>
    <hr>
 <!-- Filter course HTML -->
    <h2>Select a course</h2>
      <?php include('filtercourse.php'); ?>
    <hr>
<!--  My enrolled courses section -->
    <div>
      <h2>My current courses</h2>
      <?php include('currentcourses.php'); ?>
    </div>
  </div>

</main>
<?php include('../footer.php'); ?>
</body>
</html>