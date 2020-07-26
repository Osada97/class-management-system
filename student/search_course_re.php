<?php  
	/*Ajax*/

	require_once('../inc/connection.php');
	require_once('../inc/coursetimeago.php');

	$search = $_POST['search'];
	$student_id = $_POST['student_id'];
	$page_number = $_POST['page_number'];

	$query_se = "SELECT * FROM course WHERE course_name LIKE '%{$search}%' ORDER BY course_id DESC";
	$result_se = mysqli_query($connection,$query_se);

	if($result_se){
		if(mysqli_num_rows($result_se)>0){
			while ($alcos = mysqli_fetch_assoc($result_se)) {
				echo '<div class="col mb-4">';
					echo '<div class="card">';
						//img set
						echo "<div class='course_img'>";
						if($alcos['course_img']!=0){
							if($alcos['img_name']!=null){
								$img_name = $alcos['img_name'];
								echo '<img src="../img/course_covers/'.$img_name.'" class="card-img-top" alt="...">';
							}
							else{
								echo '<img src="../img/csd.jpg" class="card-img-top" alt="...">';
							}
						}
						else{
							echo '<img src="../img/csd.jpg" class="card-img-top" alt="...">';
						}
						echo "</div>";

						echo '<div class="card-body">';
							echo '<h4 class="card-title">'.$alcos['course_name'].'</h4>';

							//display teacher name
							$query_tc = "SELECT CONCAT(first_name,' ',last_name) AS name FROM teacher WHERE teacher_id = {$alcos['teacher_id']} LIMIT 1";
							$result_tc = mysqli_query($connection,$query_tc);

							$nam = mysqli_fetch_assoc($result_tc);
							echo '<h6><i class="fas fa-user-tie"></i>'.$nam['name'].'</h6>';

							echo "<div class= 'tiny_dis'>";
							echo "<div class='course_type'>";
								echo "<h6><i class='fas fa-graduation-cap'></i>" . $alcos['course_type'] . "</h6>";
							echo "</div>";
							echo "<div class='class_type'>";
								echo "<h6><i class='fas fa-school'></i>" . $alcos['class_type'] . "</h6>";
							echo "</div>";
							echo "</div>";

							//cheking discription has more than 100 words
							echo '<div class="bod">';
								if(strlen($alcos['description'])>80){
									echo '<p class="card-text">'.substr($alcos['description'], 0,80).'...</p>';
								}
								else{
									echo '<p class="card-text">'.$alcos['description'].'</p>';
								}
							echo '</div>';
							echo '<div class="row justify-content-center">';
								echo '<form action="dashboard.php?p='.$page_number.'" method="POST" >';
								echo '<input type="hidden" name="course_id" value="'.$alcos['course_id'].'">';
								echo '<input type="hidden" name="is_enrolled" id="is_enrolled" value="'.$alcos['is_enrolled'].'">';
								echo '<input type="text" placeholder="Enroll Key" id="enroll_key" name="enroll_key" style="opacity:0">';
								echo '<input type="hidden" id="is_enrolled" name="teacher_id" value="'.$alcos['teacher_id'].'">';
								echo '<div class="mt-4">';

									//checking student already enrolled to the course
									$query_ct = "SELECT * FROM course_enroll WHERE course_id = {$alcos['course_id']} AND student_id = '{$student_id}'";
									$result_ct = mysqli_query($connection,$query_ct);

									if($result_ct){
										if(mysqli_num_rows($result_ct)==1){
											echo '<button type="button" name="ennroll" class="btn btn-success" ><i class="fas fa-check"></i></button>';
										}
										else{
											echo '<button type="button" name="ennroll" class=" btn btn-info" onclick="checkenroll(event)">Enroll</button>';
										}
									}

									echo '<button class="btn btn-info ml-2" type="button" data-toggle="modal" data-target="#exampleModal">Read more</button>';
								echo '</div>';
								echo '</form>';
							echo '</div>';
						echo '</div>';
								echo '<div class="time">';
									echo '<p><i class="far fa-clock"></i>'.course_time_ago($alcos["date"]).'</p>';
								echo '</div>';
					echo '</div>';
				echo ' </div>';
			}
		}
		else{
			echo "<h1>No Result Found</h1>";
		}
	}

?>