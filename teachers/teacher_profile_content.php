<!DOCTYPE html>
<?php
include('../includes/dbconnection.php');

$row=array();
if ((isset($_SESSION['loggedin'])) && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql="select user_id from users where username='$username'";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo "Query error: " . mysqli_error($con);
    } else if (mysqli_num_rows($result) > 1) {
        echo "System Error";
    } else if (mysqli_num_rows($result) === 1) {

        $row = $result -> fetch_assoc();
        $user_id=$row['user_id'];
    }   
    // echo "<script>alert('$user_id');</script>";

    $tsql = "SELECT * FROM teacher WHERE teacher_id = '$user_id'";
    $tres = mysqli_query($con, $tsql);
    if (!$tres) {
        echo "Query error: " . mysqli_error($con);
    } else if (mysqli_num_rows($tres) === 0) {
        // 如果不存在记录，跳转到注册页面
        echo "<script>window.location.href='teacher_profile_register.php?teacher_id=" . htmlentities($user_id) . "';</script>";
        exit(); 
    } else if (mysqli_num_rows($tres) === 1) {
        // 如果存在记录，获取教师信息
        $trow = $tres->fetch_assoc();
        $row['teachername'] = $trow['teachername'];
        $row['teacheremail'] = $trow['teacheremail'];
        $row['department'] = $trow['department'];
        $row['gender'] = $trow['gender'];
        $row['teacher_id'] = $trow['teacher_id'];
        $row['contactnumber'] = $trow['contactnumber'];
        $row['address'] = $trow['address'];
    }
} else {
header("location:teacher_login.php");
exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System|| View Teacher Profile</title>
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
                                Profile Details
                            </td>
                        </tr>
                        <tr class="table-info">
                            <th>Teacher Name</th>
                            <td><?php echo $row['teachername'] ?></td>
                        </tr>
                        <tr class="table-info">
                            <th>Teacher ID</th>
                            <td><?php echo $row['teacher_id'] ?></td>
                        </tr>
                        <tr class="table-info">
                            <th>Teacher Email</th>
                            <td><?php echo $row['teacheremail'] ?></td>
                        </tr>
                        <tr class="table-info">
                            <th>Gender</th>
                            <td><?php echo $row['gender'] ?></td>
                        </tr>
                    
                        <tr class="table-info">
                            <th>Contact Number</th>
                            <td><?php echo $row['contactnumber'] ?></td>
                        </tr>
                        <tr class="table-info">
                            <th>Address</th>
                            <td><?php echo $row['address'] ?></td>
                        </tr>
                        <tr class="table-info">
                            <th>Department</th>
                            <td><?php echo $row['department'] ?></td>
                        </tr>
                        <td colspan="2">
                        
                                <!-- <form method="POST" action="teacher_profile_edit_firstpage.php">
                                    <input type="hidden" name="user_id" value="<?=$user_id ?>">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Edit</button>
                                </form> -->
                                <a href="teacher_profile_edit_firstpage.php?user_id=<?=$user_id?>">Edit </a>

                        </td>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>