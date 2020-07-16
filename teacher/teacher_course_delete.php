<?php ob_start() ?>
<?php require_once('../inc/connection.php') ?>
<?php session_start(); ?>

<?php  

	//checking sessions
	if(!isset($_SESSION['teacher_id'])){
		header("Location:../signin.php");
	}
	if(!isset($_GET['course_id'])){
		header("Location:../signin.php?err=nonecourseid");
	}
	if($_GET['course_id']==null){
		header("Location:../signin.php?err=nonecourseid");
	}
?>
<?php  

	if(isset($_GET['course_id'])){

		$course_id = $_GET['course_id'];

		//delete course
		$query = "DELETE FROM course WHERE course_id = {$course_id}";
		$result = mysqli_query($connection,$query);

		if($result){
			header("Location:teacher_dashboard.php?delete=true");
		}
		else{
			print_r(mysqli_error($connection));
			//header("Location:teacher_dashboard.php?delete=false");	
		}
	}



?>