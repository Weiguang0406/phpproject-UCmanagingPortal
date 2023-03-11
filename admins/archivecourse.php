<?php

include('../includes/dbconnection.php');
// Remove a course;
if(isset($_GET['delid']))
{
$rid=$_GET['delid'];

// Check the course if has class which mean has teacher assigned;
$checkExist=$con->query("SELECT * FROM (select course_id from teacher_course union select course_id from course_enrollment) cc where cc.course_id ='$rid'");
if($checkExist->num_rows ===0){
// If the course has been archived before;
$checkExist2=$con->query("SELECT * FROM deletedcourses where course_id='$rid'");

if($checkExist2->num_rows ===0){
 // Archive the course to deletedcourses table;
 $sql_achive=$con->query("INSERT INTO deletedcourses
 SELECT * FROM courses where course_id='$rid'");
//  Delete the course from courses table
 $sql=$con->query("DELETE from courses where course_id='$rid'");
 echo "<script> alert('This Course is archived successfully.') </script>";
 echo "<script type='text/javascript'> window.location.href='./admin_filtercourse.php'; </script>";
}else{
  //  Delete the course from courses table
 $sql=$con->query("DELETE from courses where course_id='$rid'");
 echo "<script> alert('This Course is archived successfully.') </script>";
 echo "<script type='text/javascript'>window.location.href='./admin_filtercourse.php'; </script>";
} 
}else{
// Remove the course;
// $sql=$con->query("delete from courses where course_id='$rid'");
echo "<script> alert('This Course is ongoing, cann't be deleted.') </script>";
}
// echo "<p class='.text-primary' >The course $rid is archived!</p>";     

// header("location: admin_allcourses.php");

} 
?>