<?php
function getNumberofregisterdCourse($student_id)
{   $coursedata = null;
    include('../includes/dbconnection.php');
    $sql = "  select s.student_id, s.studentname, DATE(s.dateofadmission) as dateofadmission, 
              u.username, count(c_e.course_id) as course_count, sum(c.credit_hours) as credit_hours,
              sum(c_e.grade) as grade
              from students s
              left join course_enrollment c_e
                  on s.student_id=c_e.student_id
              inner join users u
                  on u.user_id = s.student_id  
              inner join courses c
                  on c.course_id = c_e.course_id
              where u.roles='student'
                and s.student_id='$student_id'
              group by s.student_id";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo "System Error";
    } else {

        while ($courserow = $result->fetch_assoc()) {
            $coursedata[] = $courserow;
        }
    }
    return $coursedata;
}

function getRegisterCourseList($student_id)
{
    include('../includes/dbconnection.php');
    $sql = "select s.student_id  , s.studentname , DATE(s.dateofadmission) as dateofadmission, 
u.username ,c_e.course_id , c.course_name , c.credit_hours ,
c_e.grade ,c_e.enrollment_date  ,t.teachername 
        from students s
           left join course_enrollment c_e
        on s.student_id=c_e.student_id
              inner join users u
        on u.user_id = s.student_id
        inner join courses c 
        on c.course_id=c_e.course_id
        inner join teacher_course t_c
        on t_c.course_id = c.course_id
        inner join teacher t
        on t.teacher_id = t_c.teacher_id
        where u.roles='student'
 and s.student_id='$student_id'";

    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "System Error";
    } else {
        while ($courseList = $result->fetch_assoc()) {
            $data[] = $courseList;
        //    $temp1 = $courseList['student_id'];
         //   echo "<script>alert($temp1)</script>";
            //    $temp2=$courseList['student_id'];
            //   echo "<script>alert($temp2)</script>";
        }
    }

}

$courseList = null;
include('../includes/dbconnection.php');
if (isset($_SESSION['username'])) { //????
    $username = $_SESSION['username'];
    $user_id = "";
    $sql = "select student_id, u.username as username,studentname, studentemail, studentclass, gender, dob,fathername, mothername, 
            contactnumber, alternatenumber, address, imagefilename,dateofadmission
             from students s
inner join users u on u.user_id=s.student_id
             where u.username='$username'";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo "Query error: " . mysqli_error($con);
    } else if (mysqli_num_rows($result) > 1) {
        echo "System Error";
    } else if (mysqli_num_rows($result) === 1) {

        $row = $result->fetch_assoc();
        $user_id = $row['student_id'];
        $coursedata = getNumberofregisterdCourse($user_id);
        if (!empty($coursedata)) {
            foreach ($coursedata as $eachcourserow) {
                $totalcoursedata = $eachcourserow;

                /*      $temp1 = $totalcoursedata['course_count'];
                      $temp2 = $totalcoursedata['credit_hours'];
                      $temp3 = $totalcoursedata['grade'];

                      echo "<script>alert($temp1)</script>";
                      echo "<script>alert($temp2)</script>";
                      echo "<script>alert($temp3)</script>";
                 */
            }
            // $registedcourse_nums =9;
        }
        include('../includes/dbconnection.php');
        $sql = "select s.student_id  , s.studentname , DATE(s.dateofadmission) as dateofadmission, 
u.username ,c_e.course_id , c.course_name , c.credit_hours ,
c_e.grade ,c_e.enrollment_date  ,t.teachername 
        from students s
           left join course_enrollment c_e
        on s.student_id=c_e.student_id
              inner join users u
        on u.user_id = s.student_id
        inner join courses c 
        on c.course_id=c_e.course_id
        inner join teacher_course t_c
        on t_c.course_id = c.course_id
        inner join teacher t
        on t.teacher_id = t_c.teacher_id
        where u.roles='student'
 and s.student_id='$user_id'";

        $result = mysqli_query($con, $sql);

        if (!$result) {
            echo "System Error";
        } else {
            while ($courseList = $result->fetch_assoc()) {
                $data[] = $courseList;

            }


        }
    }

} else {
    header("location:student_login.php");

    "<script>window.location.href='../index.html'</script>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System|| View Students Profile</title>
    <link rel="stylesheet" href="	https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css">
    <link rel="stylesheet"
          href="	https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/event-drops/1.3.0/style.css"/>
</head>
<body>
<div class="signup-form" hidden>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table border="1" class="table table-bordered mg-b-0">


                        <tr align="center" class="table-warning">
                            <td colspan="4" style="font-size:20px;color:blue">
                                Students Details


                                <a href="student_editprofile.php?user_id=<?php echo htmlentities($row['student_id']); ?>"
                                   class="edit"
                                   title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            </td>
                        </tr>

                        <tr class="table-info">

                            <img src="../uploads/<?php echo $user_id; ?>.jpg" alt="Your Image" width="250px"
                                 height="250px">

                        </tr>


                        <tr class="table-primary">
                            <th>Student Name</th>
                            <td><?php echo $row['studentname'] ?></td>
                            <th>User Name</th>
                            <td><?php echo $row['username'] ?></td>
                        </tr>
                        <tr class="table-danger">
                            <th>Student Email</th>
                            <td><?php echo $row['studentemail'] ?></td>
                            <th>Student ID</th>
                            <td><?php echo $row['student_id'] ?></td>
                        </tr>

                        <tr class="table-success">
                            <th>Gender</th>
                            <td><?php echo $row['gender'] ?></td>
                            <th>Date of Birth</th>
                            <td><?php echo $row['dob'] ?></td>
                        </tr>

                        <tr class="table-info">
                            <th>Father Name</th>
                            <td><?php echo $row['fathername'] ?></td>
                            <th>Mother Name</th>
                            <td><?php echo $row['mothername'] ?></td>
                        </tr>
                        <tr class="table-primary">
                            <th>Contact Number</th>
                            <td><?php echo $row['contactnumber'] ?></td>
                            <th>Altenate Number</th>
                            <td><?php echo $row['alternatenumber'] ?> </td>
                        </tr>
                        <tr class="table-danger">
                            <th>Address</th>
                            <td><?php echo $row['address'] ?></td>
                            <th>Date of Admission</th>
                            <td><?php echo $row['dateofadmission'] ?></td>
                        </tr>


                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="signup-form">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table border="1" class="table table-bordered mg-b-0">


                        <tr align="center" class="table-warning">
                            <td colspan="7" style="font-size:20px;color:blue">
                                Registerd Course List
                            </td>

                        </tr>
                        <tr class="table-primary">
                            <th>No.</th>
                            <th>CourseName</th>
                            <th>CreditsHours</th>
                            <th>TeacherName</th>
                            <th>CourseID</th>

                            <th>Grade</th>
                            <th></th>
                        </tr>



                        <?php
                        if (!empty($data)) {
                            $index=1;
                            foreach ($data as $row) {

                                ?>
                                <tr class="table-primary">
                                    <td><?php echo $index?></td>
                                    <td><?php echo $row['course_name'] ?></td>
                                    <td><?php echo $row['credit_hours'] ?></td>
                                    <td><?php echo $row['teachername'] ?></td>
                                    <td><?php echo $row['course_id'] ?></td>

                                    <td><?php echo $row['grade'] ?></td>
<td></td>

                                </tr>
                                <?php
                                 $index = $index + 1;
                            }
                       ?>

                            <tr align="center" class="table-warning">
                                <td colspan="7" style="font-size:20px;color:blue">
                                    Course Summary
                                </td>

                            </tr>
                            <tr class="table-info">
                                <th>Total Courses </th>
                                <th></th>
                                <th>Total Credit Hours</th>
                                <th></th>
                                <th></th>
                                <th>Average
                                    Grade </th>
                                <th><?php echo $totalcoursedata['grade'] / $totalcoursedata['course_count']; ?></th>

                            </tr>
                            <tr class="table-info">
                                <th><?php echo $totalcoursedata['course_count']; ?></th>
                                <th></th>
                                <th><?php echo $totalcoursedata['credit_hours']; ?></th>
                                <th></th>
                                <th></th>
                                <th>Total Grade</th>
                                <th><?php echo $totalcoursedata['grade']; ?></th>
                            </tr>


                            <?php
                        } else { ?>
                            <tr>
                                <th style="text-align:center; color:red;" colspan="6">No Record Found</th>
                            </tr>
                        <?php } ?>




                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>