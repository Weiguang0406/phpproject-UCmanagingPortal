<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: "Lato", sans-serif;
            background-image: url("../img/T2.jpg");
        }
        .sidenav {
            height: 73%;
            width: 300px;
            position: fixed;
            z-index: 1;
            top: 150px;
            left: 0;
            /* background-color: #ffffff; */
            overflow-x: hidden;
            padding-top: 20px;
            /* border-style: inset; */
        }
        .sidenav a {
            padding: 6px 6px 6px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #002b80;
            display: block;
            text-shadow: 1px 1px 2px pink;
        }
        .sidenav a:hover {
            color: #0000b3;
        }
        main {
            padding-left: 15px;
            padding-top: 15px;
            margin-top: 160px;
            margin-left: 300px; /* Same as the width of the sidenav */
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>

</head>
<body>

<div class="sidenav">
    <a href="teacher_welcome.php"><i class="fa-regular fa-calendar-days"></i>Home</a>
    <a href="teacher_profile.php">Personal Profile</a>
    <a href="teacher_coursemanage.php">Course Management</a>
    <a href="teacher_grademanage.php">Grade Management</a>
    <a href="teacher_changePwd.php">Change Password</a>
    <a href="teacher_logout.php">Sign Out</a>
</div>


</body>
</html> 