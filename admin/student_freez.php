<?php  

	require_once('../inc/connection.php');

	print_r($_POST);

	$freez = $_POST['freez'];
	$student_id = $_POST['student_id'];

	if($freez=='false'){
		$query_up = "UPDATE student SET freez=1 WHERE st_id='{$student_id}' LIMIT 1";
		$result_up = mysqli_query($connection,$query_up);
	}
	else{
		$query_up = "UPDATE student SET freez=0 WHERE st_id='{$student_id}' LIMIT 1";
		$result_up = mysqli_query($connection,$query_up);
	}
?>