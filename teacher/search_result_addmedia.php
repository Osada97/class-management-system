<?php  
	require_once('../inc/connection.php');
	//for Ajax
	
	$search = $_POST['search'];
	$course_id = $_POST['course_id'];

	$query = "SELECT * FROM student WHERE CONCAT(first_name,' ',last_name) LIKE '%{$search}%'";
	$result = mysqli_query($connection,$query);
	if($result){
		if(mysqli_num_rows($result)>0){
			while($st = mysqli_fetch_assoc($result)){
				//query for get already in course
				$query_get ="SELECT * FROM course_enroll WHERE student_id ='{$st['st_id']}' AND course_id = {$course_id}";
				$result_get = mysqli_query($connection,$query_get);

				if($result_get){
					if(mysqli_num_rows($result_get)==0){

						echo "<li>";
							echo "<div class='st_name' hidden>"; 
								echo $st['st_id'];
							echo "</div>";
							echo "<div class='st_pic'>"; 
								if($st['is_image']!=0){
									if($st['img_name']!=null){
										echo "<img src='../img/student_pic/{$st['img_name']}'>";
									}
									else{
										echo "<img src='../img/defaultstudent.png'>";
									}
								}
								else{
									echo "<img src='../img/defaultstudent.png'>";
								}
							echo "</div>";
							echo "<div class='st_name'>"; 
								echo $st['first_name'] . " ".$st['last_name'];
							echo "</div>";
							echo "<div class='st_add'>"; 
								echo "<button type='button' class='st_add_but' onclick='add_student(event)'><i class='fas fa-plus'></i></button>";
							echo "</div>";
						echo "</li>";

					}
				}

			}
		}
		else{
			echo "<p>Student Not Found</p>";
		}
	}
?>