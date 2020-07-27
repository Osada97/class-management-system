<?php  
	require_once('../inc/connection.php');

	$teacher_id = $_POST['teacher_id'];

	$query_tc_dl =	"DELETE FROM teacher WHERE teacher_id ={$teacher_id} LIMIT 1";
	$result_tc_dl = mysqli_query($connection,$query_tc_dl);
?>