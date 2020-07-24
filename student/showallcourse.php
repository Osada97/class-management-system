<?php  
	/*Ajax*/

	require_once('../inc/connection.php');

	$student_id = $_POST['student_id'];
	$start = $_POST['start'];
	$grid_per_page =$_POST['grid_per_page'];
	$page_number = $_POST['page_number'];
	
	$query = "SELECT * FROM course ORDER BY course_id DESC LIMIT {$start},{$grid_per_page}";
	$result = mysqli_query($connection,$query);

	if($result){
		if(mysqli_num_rows($result)>0){
			while ($alcos = mysqli_fetch_assoc($result)) {
				echo '<div class="col mb-4">';
					echo '<div class="card">';
						//img set
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

						echo '<div class="card-body">';
							echo '<h5 class="card-title">'.$alcos['course_name'].'</h5>';
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
					echo '</div>';
				echo ' </div>';
			}
		}
	}

?>
              