<?php 
	require_once('../inc/connection.php');

	$student_id = $_POST['student_id'];

	$query = "SELECT * FROM student WHERE st_id='{$student_id}' LIMIT 1";
	$result_set = mysqli_query($connection,$query);

	if($result_set){
		$student_de = mysqli_fetch_assoc($result_set);

		echo '<div class="modal-content">';
			echo '<div class="modal-header">';
				echo '<h5 class="modal-title" id="exampleModalLabel">'.$student_de['first_name']." ".$student_de['last_name'].' More Details</h5>';
				echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
					echo '<span aria-hidden="true">&times;</span>';
				echo '</button>';
			echo '</div>';
			echo '<div class="modal-body">';
				echo '<div class="student_dp">';

				//student_image
				if($student_de['is_image']!=0){
					if($student_de['img_name']!=null){
						echo "<img src='../img/student_pic/".$student_de['img_name']."' alt='Profile pic' class='rounded-circle' style='width: 150px; height: 150px'>";
					}
					else{
						echo "<img src='../img/defaultstudent.png' alt='Profile pic' class='rounded-circle' style='width: 150px; height: 150px'>";
					}
				}
				else{
					echo "<img src='../img/defaultstudent.png' alt='Profile pic' class='rounded-circle' style='width: 150px; height: 150px'>";
				}
				echo '</div>';
				echo '<div class="student_details">';
					echo '<h3>Osada Manohara</h3>';
				echo '<div class="cous_det">';
					echo '<div class="numcosbox">';
						echo '<h4>Number Of Courses Stuent Enrolled</h4>';
							$query_tc_al_cos ="SELECT count(student_id) AS total_cos FROM course_enroll WHERE student_id ='{$student_de['st_id']}'";
							$result_tc_al_cos = mysqli_query($connection,$query_tc_al_cos);
							$st_de = mysqli_fetch_assoc($result_tc_al_cos);
						echo '<h6>'.$st_de['total_cos'].'</h6>';
				echo '</div>';
				echo '</div>';
					echo '<h4 class="email"><i class="far fa-envelope-open"></i>'.$student_de['email'].'</h4>';
					echo '<h5 class="number"><i class="fas fa-mobile-alt"></i>0768597090</h5>';
				echo '</div>';
				echo '</div>';
		echo '</div>';

	}

?>
