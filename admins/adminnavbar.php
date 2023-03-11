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
            height: auto;
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

        .dropdown-btn{
            padding: 6px 6px 6px 32px;
            /* text-decoration: none; */
            background-color:white;
            font-size: 25px;
            color: #002b80;
            display: block;
            text-shadow: 1px 1px 2px pink;
            border: none;
        }
/* Add an active class to the active dropdown button */
.active {
  background-color: green;
  color: white;
}
        /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  /* background-color: #262626; */
  padding-left: 20px;
}
.dropdown-container a{
    font-size: 15px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}
    </style>

</head>
<body>

<div class="sidenav">
    <a href="admin_welcome.php"><i class="fa-regular fa-calendar-days"></i>Home</a>
    <a href="admin_student_list.php">Student Management</a>
    <a href="admin_users.php">Emplyee</a>

    <!-- <a href="admin_courseMgr.php">Course Management</a> -->
    <button  class="dropdown-btn">Course
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="admin_allcourses.php">All Courses</a>
    <a href="admin_filtercourse.php">Search Course</a>
    <a href="admin_course_enrollment_status.php">Course enrollment status</a>
    <a href="admin_archivedcoures.php">Archived Course</a>
  </div>
    <a href="admin_changepassword.php">Change Password</a>
    <!-- <a href="admin_login.php">Sign in</a> -->

    <a href="admin_logout.php">Sign Out</a>
</div>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
</body>
</html> 