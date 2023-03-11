<?php
include('../includes/dbconnection.php');
$row=array();
if ((isset($_SESSION['loggedin'])) && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // echo "<script> alert('kkk=>'+'$username');</script>";
    $sql = "select student_id, studentname, studentemail, studentclass, gender, dob,fathername, mothername, 
            contactnumber, alternatenumber, address, u.username, u.password, imagefilename
             from students s
join users u on u.user_id=s.student_id
where username='$username'";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo "Query error: " . mysqli_error($con);
    } else if (mysqli_num_rows($result) > 1) {
        echo "System Error";
    } else if (mysqli_num_rows($result) === 1) {

        $row = $result -> fetch_assoc();
    }

}
else {
    header("location:student_login.php");
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
<div class="signup-form">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table border="1" class="table table-bordered mg-b-0">
                        <tr align="center" class="table-warning">
                            <td colspan="4" style="font-size:20px;color:blue">
                                Students Details
                            </td>
                        </tr>

                        <tr class="table-info">
                            <th>Student Name</th>
                            <td><?php echo $row['studentname'] ?></td>
                            <th>Student Email</th>
                            <td><?php echo $row['studentemail'] ?></td>
                        </tr>
                        <tr class="table-warning">
                            <th>Student Class</th>
                            <td><?php echo $row['studentclass'] ?></td>
                            <th>Gender</th>
                            <td><?php echo $row['gender'] ?></td>
                        </tr>
                        <tr class="table-danger">
                            <th>Date of Birth</th>
                            <td><?php echo $row['dob'] ?></td>
                            <th>Student ID</th>
                            <td><?php echo $row['student_id'] ?></td>
                        </tr>
                        <tr class="table-success">
                            <th>Father Name</th>
                            <td><?php echo $row['fathername'] ?></td>
                            <th>Mother Name</th>
                            <td><?php echo $row['mothername'] ?></td>
                        </tr>
                        <tr class="table-primary">
                            <th>Contact Number</th>
                            <td><?php echo $row['contactnumber'] ?></td>
                            <th>Altenate Number</th>
                            <td>1236987450</td>
                        </tr>
                        <tr class="table-progress">
                            <th>Address</th>
                            <td><?php echo $row['address'] ?></td>
                            <th>User Name</th>
                            <td><?php echo $row['username'] ?></td>
                        </tr>
                        <tr class="table-info">
                            <th>Profile Pics</th>
                            <td><img src="../admin/images/2f413c4becfa2db4bc4fc2ccead84f651643828242.png"></td>
                            <th>Date of Admission</th>
                            <td>2022-02-02 18:57:22</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>