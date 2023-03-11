<?php
// Remove a course;
if(isset($_GET['delid']))
{
$rid=$_GET['delid'];

$con->begin_transaction();
try{
	// $sql_insert_users="INSERT INTO users(user_id,username, password,roles)
	// VALUES('$user_id', '$username','$password','$roles')";
	
	$stmt = $con->prepare('DELETE FROM teacher_course WHERE teacher_id= ?;');
			$stmt->bind_param('s', $rid);
			
			if($stmt->execute()){
				// $sql_insert_employee="INSERT INTO teacher(teacher_id, teachername, teacheremail,department,gender,contactnumber,address) 
				// VALUES('$user_id', '$teachername','$teacheremail','$department','$gender','$contactnumber','$address');";
	
	
		 $stmt2 = $con->prepare('DELETE FROM teacher WHERE teacher_id=?;');
				$stmt2->bind_param('s', $rid);
				
        if($stmt2->execute()){

          $stmt3 = $con->prepare('DELETE FROM users WHERE user_id= ?;');
          $stmt3->bind_param('s', $rid);
          $stmt3->execute();
    
          /* If code reaches this point without errors then commit the data in the database */
          $con->commit();
          echo "<script>alert('The user is successfully removed！');</script>";
          echo "<script type='text/javascript'>window.location.href='./admin_users.php'; </script>";
        }else{
          echo "<script>alert('Something Went Wrong. Please try again');</script>";

        }
			}else{
				echo "<script>alert('Something Went Wrong. Please try again');</script>";
			};
		
}catch (mysqli_sql_exception $exception) {
	$con->rollback();

	throw $exception;
	echo "<script>alert('Something Went Wrong. Please try again');</script>";
}

}

?>