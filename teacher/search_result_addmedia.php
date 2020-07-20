<?php  
	require_once('../inc/connection.php');
	
	$search = $_POST['search'];

	$query = "SELECT * FROM student WHERE CONCAT(first_name,' ',last_name) LIKE '%{$search}%'";
	$result = mysqli_query($connection,$query);
	if($result){
		if(mysqli_num_rows($result)>0){
			while($st = mysqli_fetch_assoc($result)){
				echo "<li>";
					echo "<div class='st_name' hidden>"; 
						echo $st['st_id'];
					echo "</div>";
					echo "<div class='st_pic'>"; 
						echo "<img src='../img/defaultteacher.png'>";
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
		else{
			echo "<p>Student Not Found</p>";
		}
	}
?>