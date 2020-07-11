<?php include('inc/header.php')?>
<?php include ('inc/nav.php')?>
<?php require_once ('inc/connection.php')?>

<?php	
	$errors = array();

	if(isset($_POST['submit'])){

		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$password = mysqli_real_escape_string($connection,$_POST['password']);

		//checking fields are empty or not
		if(empty(trim($_POST['email']))){
			$errors[] = "User name Field Is Required";
		}
		if(empty(trim($_POST['password']))){
			$errors[] = "Password Field Is Required";
		}

		//checking fields limit
		if(strlen($email) > 200){
			$errors[] = "User name Field Must Be Less Than 20 Characters";
		}
		if(strlen($password) > 12){
			$errors[] = "Password Field Must Be Less Than 12 Characters";
		}


		if(empty($errors)){

			$enc_password = sha1($password);

			//checking student or admin or teacher
			$query = "SELECT * FROM student WHERE email = '{$email}' AND password = '{$enc_password}' AND freez = 0 LIMIT 1";
			$result = mysqli_query($connection,$query);

			if($result){
				//executing student
				if(mysqli_num_rows($result)==1){
					header("Location:student_dashboard.php");
				}
				else{
					echo "teacher or admin";
					$query = "SELECT * FROM teacher WHERE email = '{$email}' AND password = '{$enc_password}' AND freez = 0 LIMIT 1";
					$result = mysqli_query($connection,$query);

					if($result){
						if(mysqli_num_rows($result)==1){
							header("Location:teacher_dashboard.php");
						}
						else{
							echo "admin";
						}
					}
					else{
						print_r(mysqli_error($connection));
					}

				}

			}
			else{
				print_r(mysqli_error($connection));
				
			}

		}


	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LankaE learn</title>
	<link rel="stylesheet" href="css/signin.css">
</head>
<body>

	<div class="container text-center mt-4 mb-4">
		
		<h2>Sign In</h2>
	</div>
		<!-- display errors -->
		<?php 
			echo "<div class ='errors'>";
				if(!empty($errors)){
					foreach ($errors as $value) {
						echo "<p>" . $value . "</p>";
					}
				}
			echo "</div>";

		?>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
	
<form action="signin.php" method="POST" >
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12 text-center">
      <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
  </div>
</form>
</div>	
<div class="col-md-4"></div>




</body>
<?php mysqli_close($connection); ?>
</html>
<div class="container text-center">
<?php include('inc/footer.php')?>
</div>