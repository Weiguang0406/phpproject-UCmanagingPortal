<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home</title>
</head>
<style>
    html {
        background-color: #f2f2f2;
    }
    .home{
        height:600px;
    }

</style>
<body>
<?php include('../header.php'); ?>
<?php include('adminnavbar.php'); ?>
<main class="home">
    <div class="bg-pink m-3 ">


        <div class="bg-info m-3">
            <?php include('student_list.php'); ?>
        </div>
    </div>
</main>
<?php include('../footer.php'); ?>
</body>
</html>


