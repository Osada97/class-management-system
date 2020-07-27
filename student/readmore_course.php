<?php
	require_once('../inc/connection.php');  

	$course_id = $_POST['course_id'];

	$query = "SELECT * FROM course WHERE course_id ={$course_id}";
	$result = mysqli_query($connection,$query);

	if($result){
		$cos_det = mysqli_fetch_assoc($result);

		//getting teacher name
		$query_tc ="SELECT CONCAT(first_name,' ',last_name) AS name FROM teacher WHERE teacher_id={$cos_det['teacher_id']} LIMIT 1";
		$result_tc = mysqli_query($connection,$query_tc);

		$nam = mysqli_fetch_assoc($result_tc);

		echo '<h5>Teacher: '.$nam['name'].'</h5>';
		echo '<div class="course_grid">';
		echo '<div class="tostudent_grid">';

		//getting total students
		$query_st ="SELECT COUNT(student_id) AS total_student FROM course_enroll WHERE teacher_id={$cos_det['teacher_id']} AND course_id ={$course_id}";
		$result_st = mysqli_query($connection,$query_st);

		if(mysqli_num_rows($result_st)>0){	
			$tot = mysqli_fetch_assoc($result_st);
			echo '<h6><i class="fas fa-user-graduate"></i><span>' . $tot['total_student'] . '</span></h6>';
		}
		else{
			echo '<h6><i class="fas fa-user-graduate"></i><span>0</span></h6>';
		}
		echo '</div>';
		echo '<div class="coure_type_grid">';
		echo '<h6><i class="fas fa-graduation-cap"></i><span>'.$cos_det['course_type'].'</span></h6>';
		echo '</div>';
		echo '<div class="class_type_grid">';
		echo '<h6><i class="fas fa-school"></i><span>'.$cos_det['class_type'].'</span></h6>';
		echo '</div>';
		echo '</div>';
		echo '<div class="dis">';
		echo '<p>'.$cos_det['description'].'</p>';
		echo '</div>';

	}

?>