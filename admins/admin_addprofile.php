<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home</title>
</head>
<style>
    html{
        background-color:#f2f2f2;
    }
</style>
<body>
<?php include('../header.php'); ?>
<?php include('adminnavbar.php'); ?>
<main >
    <div class="bg-pink m-3 ">
        <h2 class="m-3">Student Profile </h2>

        <div class="bg-info m-3">


        <?php include('addprofile.php'); ?>

        </div>
    </div>

</main>
<?php include('../footer.php'); ?>
</body>
</html>

