<?php
//database conection  file
include('../includes/dbconnection.php');
//Code for deletion

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Course Management</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>

<div>

    <div class="container-xl">
        <div class="">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2>Courses <b>Management</b> Page</h2>
                        </div>
                        <!-- <div class="col-sm-7" align="right">
                            <a href="course_add.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add Your Courses</span></a>
                            
                        </div> -->
                    </div>
                </div>
                <form name= "course_form" method="post">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><span style="width: 10px;">#</span></th>
                                <th>
                                    <select name="course id_filter" class="form-control" style="width: 120px;">
                                        <option value="">Course ID</option>
                                        <?php
                                            $query = "SELECT DISTINCT course_id FROM courses";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $course_id = $row['course_id'];
                                                $selected = ($_POST['course_id_filter'] ?? '') == $course_id ? 'selected' : '';
                                                echo "<option value='$course_id' $selected>$course_id</option>";
                                            }
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <select name="course_name_filter" class="form-control" style="width: 130px;">
                                        <option value="">Course Name</option>
                                        <?php
                                            $query = "SELECT DISTINCT course_name FROM courses";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $course_name = $row['course_name'];
                                                $selected = ($_POST['course_name_filter'] ?? '') == $course_name ? 'selected' : '';
                                                echo "<option value='$course_name' $selected>$course_name</option>";
                                            }
                                        ?>
                                    </select>
                                </th>

                                <th>
                                    <select name="credit_hours_filter" class="form-control" style="width: 120px;">
                                        <option value="">Credit Hours</option>
                                        <?php
                                            $query = "SELECT DISTINCT credit_hours FROM courses";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $credit_hours = $row['credit_hours'];
                                                $selected = ($_POST['credit_hours_filter'] ?? '') == $credit_hours ? 'selected' : '';
                                                echo "<option value='$credit_hours' $selected>$credit_hours</option>";
                                            }
                                        ?>
                                    </select>
                                </th>

                                <th>
                                    <select name="department_filter" class="form-control" style="width: 130px;">
                                        <option value="">Department</option>
                                        <?php
                                            $query = "SELECT DISTINCT department FROM courses";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $department = $row['department'];
                                                $selected = ($_POST['department_filter'] ?? '') == $department ? 'selected' : '';
                                                echo "<option value='$department' $selected>$department</option>";
                                            }
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <select name="semester_filter" class="form-control" style="width: 100px;">
                                        <option value="">Semester</option>
                                        <?php
                                            $query = "SELECT DISTINCT semester FROM courses";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $semester = $row['semester'];
                                                $selected = ($_POST['semester'] ?? '') == $semester ? 'selected' : '';
                                                echo "<option value='$semester' $selected>$semester</option>";
                                            }
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <select name="schedule_filter" class="form-control" style="width: 100px;">
                                        <option value="">Schedule</option>
                                        <?php
                                            $query = "SELECT DISTINCT schedule FROM courses";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $schedule = $row['schedule'];
                                                $selected = ($_POST['schedule_filter'] ?? '') == $schedule ? 'selected' : '';
                                                echo "<option value='$schedule' $selected>$schedule</option>";
                                            }
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <button type="submit" name="filter" class="btn btn-secondary">Filter</button>
                                </th>
                                <th>
                                <button type="button" class="btn btn-secondary" onclick="resetFilter()">Reset</button>
                                </th>
                                <script>
                                  function resetFilter() {
                                       var selectElements = document.getElementsByTagName('select');
                                        for (var i = 0; i < selectElements.length; i++) {
                                        selectElements[i].selectedIndex = 0;
                                          }
                                          document.forms["course_form"].submit();
                                          }
                                </script>
                                </th>
                            </tr>    
                            <tr>
                            </tr>      
                        </thead>
                      
                        <tbody>
                            <?php

                                if (isset($_POST['reset'])) {
                                    $_POST = array();
                                }
                                if (isset($_POST['filter'])) {
                                    $course_id_filter = $_POST['course_id_filter'] ?? '';
                                    $course_name_filter = $_POST['course_name_filter'] ?? '';
                                    $credit_hours_filter = $_POST['credit_hours_filter'] ?? '';
                                    $department_filter = $_POST['department_filter'] ?? '';
                                    $semester_filter = $_POST['semester_filter'] ?? '';
                                    $schedule_filter = $_POST['schedule_filter'] ?? '';

                                    $query = "SELECT * FROM courses WHERE 1=1 ";
                                    if (!empty($course_id_filter)) {
                                        $query .= " AND course_id='$course_id_filter'";
                                    }
                                    if (!empty($course_name_filter)) {
                                        $query .= " AND course_name='$course_name_filter'";
                                    }
         
                                    if (!empty($credit_hours_filter)) {
                                        $query .= " AND credit_hours='$credit_hours_filter'";
                                    }            
                                    if (!empty($department_filter)) {
                                        $query .= " AND department='$department_filter'";
                                    }         
                                    if (!empty($semester_filter)) {
                                        $query .= " AND semester='$semester_filter'";
                                    }
                                    if (!empty($schedule_filter)) {
                                        $query .= " AND schedule='$schedule_filter'";
                                    }
                                    $result = mysqli_query($con, $query);
                                }

                                    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] === true)) {
                                    $username = $_SESSION['username'];
                                    $sql = "SELECT user_id FROM users WHERE username = '$username'";
                                    $res = mysqli_query($con, $sql);
                                    $urow = $res->fetch_assoc();
                                    $user_id = $urow['user_id'];
                                    $teacher_id=$user_id;
                                    } 
                                    if (mysqli_num_rows($result) > 0) {
                                        $id = 1 ;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>' . $id . '</td>';
                                            echo '<td>' . $row['course_id'] . '</td>';
                                            echo '<td>' . $row['course_name'] . '</td>';
                                            echo '<td>' . $row['credit_hours'] . '</td>';
                                            echo '<td>' . $row['department'] . '</td>';
                                            echo '<td>' . $row['semester'] . '</td>';
                                            echo '<td>' . $row['schedule'] . '</td>';
                                            echo '<td>';     

                                            $course_id = $row['course_id'];
                                            $tsql = "SELECT course_id FROM teacher_course WHERE teacher_id = '$user_id'";   
                                            $tres = mysqli_query($con, $tsql);
                                            $trow = mysqli_fetch_assoc($tres);
                                            // Check if the teacher has any courses assigned
                                            $has_courses = false;

                                            foreach ($tres as $trow) {
                                                if (!empty($trow['course_id']) && $trow['course_id'] == $course_id) {
                                                    $has_courses = true;
                                                    echo '<a href="teacher_course_read.php?course_id='.htmlentities($row['course_id']).'" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>';
                                                    echo '<a href="teacher_course_edit.php?course_id='.htmlentities($row['course_id']).'" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>';
                                                }
                                            }
                                            if (!$has_courses) {
                                                echo '<a href="teacher_course_read.php?course_id='.htmlentities($row['course_id']).'" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>';
                                            }                                            
                                            echo '</td>';
                                            echo '</tr>';
                                            $id++;
                                        }
                                    }
                                        ?>
                                    </tbody>
                                    </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                </body>
            </html>