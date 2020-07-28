<?php  
	require_once('../inc/connection.php');

	$teacher_id = $_POST['teacher_id'];
	$freez = $_POST['freez'];

	if($freez == 'false'){
		$query_freez = "UPDATE teacher SET freez=1 WHERE teacher_id = {$teacher_id} LIMIT 1";
		$result_freez = mysqli_query($connection,$query_freez);

	}
	else{
		$query_freez = "UPDATE teacher SET freez=0 WHERE teacher_id = {$teacher_id} LIMIT 1";
		$result_freez = mysqli_query($connection,$query_freez);

	}

?>