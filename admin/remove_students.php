<?php  
	require_once('../inc/connection.php');
	
	
	$student_no = $_POST['student_no'];

	$delete_query = "DELETE FROM student WHERE st_id = '{$student_no}' LIMIT 1";
	$result_delete = mysqli_query($connection,$delete_query);

	if($result_delete){

	}
	else{
		print_r(mysqli_error($connection));
	}

?>