<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: "Lato", sans-serif;
        }
 .notice_card{display: flex;}
        .sidenav {
            height: 70%;
            width: 300px;
            position: fixed;
            z-index: 1;
            top: 150px;
            left: 0;
            background-color: #ffffff;
            overflow-x: hidden;
            padding-top: 20px;
            border-style: inset;

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
    <a href="student_welcome.php"><i class="fa-regular fa-calendar-days"></i>Home</a>
    <a href="student_courseenrollment.php">Register Course</a>
    <a href="student_queryCourseandGrade.php">Course&Grade</a>

    <a href="student_profile.php">Profile</a>
    <a href="student_changepassword.php">Change Password</a>
    <a href="student_logout.php">Sign Out</a>
</div>


</body>
</html> 