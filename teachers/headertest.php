<?php
$header_username = "";
session_start();
if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] === true)) {
    $header_username = $_SESSION['username'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
          <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
          <title>Document</title>
    <script src="js/jquery-1.10.1.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/footer.js" type="text/javascript"></script>

</head>
<style>
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
<header>
    <h1 class="text-center"> Welcome <?php echo $header_username ?> </h1>
        <div class="weather">
            <div class="weathertitle">
                <img src="../imgs/weather_img.png" width="50px" height="50px" alt="eathericon" />
            </div>
            <div class="temperature">
                <h1 class="temperature_value" id="temperature_value">-1</h1>
                <p class="c_value"><sup>O</sup>C</p>
                <p class="seperator">|</p>

                <p class="f_value"><sup>O</sup>F</p>
            </div>
            <div class="weather_right">
                <div class="Precipitation">
                    Precipitation:<span id="precipitation_value">15</span>%
                </div>
                <div class="humidity">
                    Humidity:<span id="humidity_value">40</span>%
                </div>
                <div class="wind">Wind:<span id="wind_value">7</span> km/h</div>
            </div>
</header>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>About Us</h5>
                <p>We are the PHP project admin team!!</p>
            </div>
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p>Email: info@collegeportal.com</p>
                
            </div>
            <div class="col-md-4">
                <h5>Follow Us</h5>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div>
        <hr>
        <p class="text-center">Copyright &copy; <?php echo date("Y"); ?>
            College Portal</p>
    </div>
</footer>
</body>
</html>