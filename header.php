<?php
$header_username = "";

if(
    !session_start()
){
    session_start();
}

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
        width: 250px;
    }

    .weather {
        width: 45%;
        height: 50px;
        display: flex;
        flex-direction: row;
    }

    .weather .temperature_value {
        font-size: 50px;
        font-weight: 400;
        margin-left: 15px;
    }

    .weather .c_value {
        font-size: 25px;
        font-weight: 400;
    }

    .weather .c_value sup {
        font-size: 10px;
        font-weight: 400;
    }

    .temperature .f_value {
        font-size: 25px;
        font-weight: 400;
    }

    .temperature .seperator {
        margin-left: 2px;
        margin-right: 2px;
        font-size: 22px;
        font-weight: 800;
    }

    .temperature .f_value sup {
        font-size: 10px;
        font-weight: 400;
    }

    .temperature {
        display: flex;
        flex-direction: row;
    }

    .weather_right {
        margin-left: 15px;
        font-size: 12px;
        margin-top: 4px;
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
              <!--  <div class="humidity">
                    Humidity:<span id="humidity_value">40</span>%
                </div>
                -->
                <div class="wind">Wind:<span id="wind_value">7</span> km/h</div>
            </div>

</header>

</body>
</html>