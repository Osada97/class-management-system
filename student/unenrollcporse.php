<?php ob_start(); ?>
<?php require_once('../inc/connection.php'); ?>
<?php session_start(); ?>

<?php  

	if(!isset($_SESSION['student_id'])){
		header('Location:../signin.php');
	}
	if(!isset($_GET['course_id'])){
		header("Location:index.php");
	}
	else{

		$course_id = $_GET['course_id'];
		$student_id =$_SESSION['student_id'];

		$query = "DELETE FROM course_enroll WHERE course_id = {$course_id} AND student_id = '{$student_id}' LIMIT 1";
		$result = mysqli_query($connection,$query);

		if($result){
			header("Location:index.php");
		}
		else{
			print_r(mysqli_error($connection));
		}
	}


?>