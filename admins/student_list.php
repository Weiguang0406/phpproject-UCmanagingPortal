<?php
//database conection  file
include('../includes/dbconnection.php');
//Code for deletion
/*if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $sql = mysqli_query($con, "delete from course where code=$rid");
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'index.php'</script>";
}*/
if (isset($_GET['user_id'])) {

    $del_user_id = $_GET['user_id'];
    $sql1 = "delete  from students where student_id='$del_user_id'";
    $sql2 = "delete  from users where user_id='$del_user_id'";


    $result1 = mysqli_query($con, $sql1);
    if ($result1) {
        $result2 = mysqli_query($con, $sql2);
        if ($result2) {
          //  ; echo "<script>alert('Student deleted');</script>";
            //delete file in uploads php
            $file_path = "../uploads/".$del_user_id.".jpg"; // 指定文件路径
      //      echo "<script>alert('$file_path');</script>";
            if(file_exists($file_path)) { // 检查文件是否存在
                unlink($file_path); // 删除文件
           //     echo "<script>alert('Photoes File Deleted');</script>";

            }

        }else{
            echo "System Error SQL1 error";
        }
    } else {
        echo "System Error sql2 error";
    }
}



    $sql = " select s.student_id, s.studentname, DATE(s.dateofadmission) as dateofadmission, u.username,count(c_e.course_id) as course_count
        from students s
           left join course_enrollment c_e
        on s.student_id=c_e.student_id
              inner join users u
        on u.user_id = s.student_id  
        where u.roles='student'
         group by s.student_id";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo "System Error";
    } else {

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }


/*if (!empty($data)) {
    echo "<script>alert('OO');</script>";
    foreach ($data as $row) {

        $kk = $row['student_id'];
        echo "<script>alert('$kk')</script>";
    }
}
*/


function getCourseList($student_id)
    {

        $sql = "select c.course_name as course_name from courses  c
inner join course_enrollment c_e
on  c_e.course_id = c.course_id 
inner join students s
on s.student_id=c_e.student_id";
        $con = mysqli_connect("localhost", "root", "111111", "studentms");
//changed later bu danli huang
        $result = mysqli_query($con, $sql);
        $course = array();

        while ($value = $result->fetch_assoc()) {

            array_push($course, $value['course_name']);
            //$course[]=$each_course_name;
        }
        return $course;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Elegant Table Design</title>
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
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
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


                        <h2>Student <b>Management</b></h2>
                    </div>
                    <div class="col-sm-7" align="right">
                        <a href="admin_addprofile.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i>
                            <span>Add a Student</span></a>

                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>



                <tr>
                    <th>Student ID</th>
                    <th>Student Full Name</th>
                    <th>Student User Name</th>
                    <th>Admission Date</th>
                    <th>The number of registed course</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($data)) {
                    foreach ($data as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['student_id']; ?></td>
                            <td><?php echo $row['studentname']; ?></td>

                            <td> <?php echo $row['username']; ?></td>
                            <td><?php echo $row['dateofadmission']; ?></td>
                            <td><?php echo $row['course_count']; ?></td>


                            <td>
                                <a href="admin_queryprofile.php?user_id=<?php echo htmlentities($row['student_id']); ?>"
                                   class="view"
                                   title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a href="admin_editprofile.php?user_id=<?php echo htmlentities($row['student_id']); ?>"
                                   class="edit"
                                   title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>

                                <a href="admin_student_list.php?user_id=<?php echo($row['student_id']); ?>" class="delete" title="Delete"
                                   data-toggle="tooltip" onclick="return confirm('Do you really want to Delete ?');"><i
                                            class="material-icons">&#xE872;</i></a>

                            </td>
                        </tr>
                        <?php
                        // $cnt = $cnt + 1;
                    }
                } else { ?>
                    <tr>
                        <th style="text-align:center; color:red;" colspan="6">No Record Found</th>
                    </tr>
                <?php } ?>

                </tbody>


            </table>

        </div>
    </div>
</div>
</body>
</html>