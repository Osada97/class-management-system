<?php 
	require_once('../inc/connection.php');

	$teacher_id = $_POST['teacher_id'];

	$query = "SELECT * FROM teacher WHERE teacher_id={$teacher_id} LIMIT 1";
	$result_set = mysqli_query($connection,$query);

	if($result_set){
		$teacher_de = mysqli_fetch_assoc($result_set);

		echo '<div class="modal-content">';
			echo '<div class="modal-header">';
				echo '<h5 class="modal-title" id="exampleModalLabel">'.$teacher_de['first_name']." ".$teacher_de['last_name'].' More Details</h5>';
				echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
				echo '<span aria-hidden="true">&times;</span>';
				echo '</button>';
			echo '</div>';
			echo '<div class="modal-body">';
				echo '<div class="teacher_dp">';

					//getting teacher picture
					if($teacher_de['is_image']!=0){
						if($teacher_de['image_name']!=null){
							echo '<img src="../img/teacher_pic/'.$teacher_de['image_name'].'" alt="Profile pic" class="rounded-circle" style="width: 150px; height: 150px">';
						}
						else{
							echo '<img src="../img/defaultteacher.png" alt="Profile pic" class="rounded-circle" style="width: 150px; height: 150px">';
						}
					}
					else{
						echo '<img src="../img/defaultteacher.png" alt="Profile pic" class="rounded-circle" style="width: 150px; height: 150px">';
					}

				echo '</div>';
			echo '<div class="teacher_details">';
				echo '<h3>'.$teacher_de['first_name']." ".$teacher_de['last_name'].'</h3>';
			echo '<div class="cous_det">';
			echo '<div class="numcosbox">';
				echo '<h4>Number Of Courses Teacher Provide</h4>';

				//number courses teacher provide
					$query_tot_cos = "SELECT count(course_id) AS number_of_courses FROM course WHERE teacher_id ={$teacher_id}";
					$result_tot_cos = mysqli_query($connection,$query_tot_cos);
					$total_course = mysqli_fetch_assoc($result_tot_cos);
					echo '<h6>'.$total_course['number_of_courses'].'</h6>';
				echo '</div>';
				echo '<div class="numstbox">';
					echo '<h4>Number Of Students Teacher Have</h4>';

						//number of students teacher have
						$query_st_cos = "SELECT count(student_id) AS number_of_students FROM course_enroll WHERE teacher_id ={$teacher_id}";
						$result_st_cos = mysqli_query($connection,$query_st_cos);
						$total_student = mysqli_fetch_assoc($result_st_cos);
						echo '<h6>'.$total_student['number_of_students'].'</h6>';
				echo '</div>';
			echo '</div>';
				echo '<h4 class="email"><i class="far fa-envelope-open"></i>'.$teacher_de['email'].'</h4>';
			echo '<div class="tc_skills">';
				echo '<div class="tc_skills">';
				echo "<h5>Teacher Skills</h5>";
				echo '<ul>';

				//teacher skills 
					if($teacher_de['skills']!=null){
						//convert to array
						$sk=explode('/', $teacher_de['skills']);
						foreach ($sk as  $value) {
							echo '<li><i class="fas fa-angle-double-up"></i>';
								echo $value;
							echo "</li>";
						}
					}
				echo '</ul>';
				echo '</div>';
			echo '</div>';
				echo '<h5 class="number"><i class="fas fa-mobile-alt"></i>'.$teacher_de['phone_number'].'</h5>';
			echo '</div>';
		echo '</div>';

	}

?>
