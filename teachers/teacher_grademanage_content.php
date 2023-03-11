<?php
//database conection  file
include('../includes/dbconnection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Redirect page</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Roboto', sans-serif;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    font-size: 15px;
    padding-bottom: 10px;
    margin: 0 0 10px;
    min-height: 45px;
}
.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}
.table-title select {
    border-color: #ddd;
    border-width: 0 0 1px 0;
    padding: 3px 10px 3px 5px;
    margin: 0 5px;
}
.table-title .show-entries {
    margin-top: 7px;
}
.search-box {
    position: relative;
    float: right;
}
.search-box .input-group {
    min-width: 200px;
    position: absolute;
    right: 0;
}
.search-box .input-group-addon, .search-box input {
    border-color: #ddd;
    border-radius: 0;
}
.search-box .input-group-addon {
    border: none;
    border: none;
    background: transparent;
    position: absolute;
    z-index: 9;
}
.search-box input {
    height: 34px;
    padding-left: 28px;     
    box-shadow: none !important;
    border-width: 0 0 1px 0;
}
.search-box input:focus {
    border-color: #3FBAE4;
}
.search-box i {
    color: #a0a5b1;
    font-size: 19px;
    position: relative;
    top: 8px;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table td:last-child {
    width: 130px;
}
table.table td a {
    color: #a0a5b1;
    display: inline-block;
    margin: 0 5px;
}
table.table td a.view {
    color: #03A9F4;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;
}
table.table td i {
    font-size: 19px;
}    
.pagination {
    float: right;
    margin: 0 0 5px;
}
.pagination li a {
    border: none;
    font-size: 13px;
    min-width: 30px;
    min-height: 30px;
    padding: 0 10px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 30px !important;
    text-align: center;
}
.pagination li a:hover {
    color: #666;
}   
.pagination li.active a {
    background: #03A9F4;
}
.pagination li.active a:hover {        
    background: #0397d6;
}
.pagination li.disabled i {
    color: #ccc;
}
.pagination li i {
    font-size: 16px;
    padding-top: 6px
}
.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}
</style>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>Students <b>Enrollment/Grade</b> Managment</h2>
                    <!-- </div>
                       <div class="col-sm-7" align="right">
                        <a href="register.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add A Grade</span></a>
                    </div> -->
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CourseEnrollment_ID</th>
                        <th>Student_ID</th>                       
                        <th>Course_ID</th>
                        <th>Course_Name</th>
                        <!-- <th>Enrollment_Date</th> -->
                        <th>Grade</th>
                        <th>Teacher_ID</th>
                    </tr>
                </thead>
                <tbody>
<?php 
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] === true)) {
    $username = $_SESSION['username'];
    $sql = "SELECT user_id FROM users WHERE username = '$username'";
    $res = mysqli_query($con, $sql);
                        
    $urow = $res->fetch_assoc();
    $user_id = $urow['user_id'];
//   echo "<script>alert('$user_id')</script>";
}

        $sql="SELECT ce.id, ce.student_id, ce.course_id, ce.enrollment_date, c.course_name, ce.grade, tc.teacher_id
        FROM course_enrollment ce
        JOIN courses c ON ce.course_id=c.course_id
        JOIN teacher_course tc ON c.course_id=tc.course_id
        WHERE tc.teacher_id='$user_id'";

        $ret=mysqli_query($con, $sql);
        $cnt=1;
        $row=mysqli_num_rows($ret);
        if($row>0){
            $id = 1;
        while ($row=mysqli_fetch_array($ret)) {
?>
<!--Fetch the Records -->
                    <tr>
                        <!-- <td><?php  echo $cnt;?></td> -->
                        <td><?php echo $id;?></td>
                        <td><?php  echo $row['id'];?></td>
                        <td><?php  echo $row['student_id'];?></td>
                        <td><?php  echo $row['course_id'];?></td>
                        <td><?php  echo $row['course_name'];?></td>
                        <!-- <td><?php  echo $row['enrollment_date'];?></td>                         -->
                        <td><?php  echo $row['grade'];?></td>
                        <td><?php  echo $row['teacher_id'];?></td>
                        <td>
                            <a href="teacher_grade_read.php?viewid=<?php echo htmlentities ($row['id']);?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>               
                            <a href="teacher_grade_edit.php?editid=<?php echo htmlentities ($row['id']);?>" title="Edit"><span style="color:black">Add/Modify Grade</span></a>
                             <!-- <a href="teacher_grade_edit.php?editid=<?php echo htmlentities ($row['id']);?>" class="btn btn-secondary" title="Edit"><i class="material-icons">&#xE147;</i> <span>Add/Modify Grade</span></a> -->                
                        </td>
                    </tr>
                    <?php 
$id++;
} } else {?>
<tr>
    <th style="text-align:center; color:Blue;" colspan="6">No Student Enroll Your Courses</th>
</tr>
<?php } ?>                 
                
                </tbody>
            </table>
         </div>
    </div>
</div>     
</body>
</html>