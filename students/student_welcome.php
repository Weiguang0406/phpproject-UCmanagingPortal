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
        background-color:#fff;
    }
    .homepage {
        background: #fff;
        color: #0b5ed7;
        height:100%;
   }
    .mainhomepage {
        background: #fff;
        color: #0b5ed7;
        height:600px;
    }

</style>
<body>
<?php include('../header.php'); ?>
<?php include('studentnavbar.php'); ?>
<main class="mainhomepage">
    <div class="homepage">
              <div class="homepage">
            <?php include('welcome.php'); ?>
        </div>
    </div>
</main>
<?php include('../footer.php'); ?>
</body>
</html>



