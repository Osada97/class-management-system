<?php  
	require_once('../inc/connection.php');
	//for Ajax

	$course_id = $_POST['course_id'];

	$query_get = "SELECT student_id FROM course_enroll WHERE course_id = {$course_id}";
	$result_get = mysqli_query($connection,$query_get);

	if($result_get){
		if(mysqli_num_rows($result_get) > 0){
			while($st_id = mysqli_fetch_assoc($result_get)){
				$student_id = $st_id['student_id'];
				$query_st = "SELECT * FROM student WHERE st_id = '{$student_id}' LIMIT 1";
				$result_st = mysqli_query($connection,$query_st);

				if($result_st){
					if(mysqli_num_rows($result_st)!=0){
						$stallde = mysqli_fetch_assoc($result_st);
						echo "<div class='st_row'>";
							echo "<div class='pro_pic'>";
								echo "<div class='picpic'>";
									if($stallde['is_image']!=0){
										if($stallde['img_name']!=null){
											echo "<img src='../img/student_pic/{$stallde['img_name']}'>";
										}
										else{
											echo "<img src='../img/defaultstudent.png'>";
										}
									}
									else{
										echo "<img src='../img/defaultstudent.png'>";
									}
								echo "</div>";
							echo "</div>";
							echo "<div class='pro_name'>";
								echo "<h5>" . $stallde['first_name'] . " " .$stallde['last_name']."</h5>";
							echo "</div>";
							echo "<div class='pro_del'>";
							$st_id = $stallde['st_id'];
								echo "<button type='button' name='dlstbut' onclick='student_remove(\"{$st_id}\")' title='Remove Student'><i class='fas fa-minus-circle'></i></button>";
							echo "</div>";
						echo "</div>";
					}
				}
			}
		}
		else{
			echo "<h3>No Student Enrolled Yet</h5>";
		}
	}
?>