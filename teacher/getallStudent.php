<?php  
	require_once('../inc/connection.php');

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
									echo "<img src='../img/defaultteacher.png'>";
								echo "</div>";
							echo "</div>";
							echo "<div class='pro_name'>";
								echo "<h5>" . $stallde['first_name'] . " " .$stallde['last_name'];
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