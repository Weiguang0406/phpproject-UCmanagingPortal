<?php
session_start();
$_SESSION=array();
session_destroy();
header("location: ../index.html");
// header("location: teacher_login.php");

exit;
?>