<?php
	//for Ajax  
	require_once('../inc/connection.php');

	$student_id = $_POST['student_id'];
	$course_id = $_POST['course_id'];

	$query = "DELETE FROM course_enroll WHERE student_id='{$student_id}' AND course_id ={$course_id} LIMIT 1";
	$result= mysqli_query($connection,$query);

?>