<?php
session_start();
// Check if the user is logged in and if has the right priviledge, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["roles"] !== "admin") {
    header("location: ../authentic/login.php");
    exit;
}
?>


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

    .homepage {
        background: #fff;
        color: #0b5ed7;
        height: 550px;
    }

    header {
        top: 0;
        left: 0;
        height: 150px;
        width: 100%;
        position: fixed;
        background-image: url("https://storage.googleapis.com/webproject_group4/php-pro/blue_hexagon_header.jpg");
        background-repeat: no-repeat;
        background-size: 100% 150px;
        z-index: 1;
    }
    .weather{
        margin-left: 100px;
        display:flex;
        flex-direction: row;
        width: 200px;

    }
    footer {
        background-color: #87CEEB;
        color: white;
        height: 80px;
        text-align: center;
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    footer p {
        margin-top: 10px;
    }
</style>
<body>
<?php include('../header.php'); ?>
<?php include('adminnavbar.php'); ?>
<main>


    <div class="homepage">
        <div class="homepage">
            <?php include('welcome.php'); ?>
        </div>
    </div>


</main>
<?php include('../footer.php'); ?>

</body>
</html>



