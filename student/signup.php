<?php ob_start(); ?>
<?php include('inc/header.php') ?>
<?php include('inc/nav.php') ?>
<?php include('inc/connection.php') ?>


<?php  
    
    $errors = array();

    $firstname =     "";
    $lastname =      "";
    $username =      "";
    $email =         "";
    $phonenumber =   "";

    if(isset($_POST['submit'])){

        $firstname =    $_POST['firstname'];
        $lastname =     $_POST['lastname'];
        $username =     $_POST['username'];
        $email =        $_POST['email'];
        $phonenumber =  $_POST['phonenumber'];

        //checking fields are empty or not
        if(empty(trim($_POST['firstname']))){
            $errors[] = "First Name Field Is Empty";
        }
        if(empty(trim($_POST['lastname']))){
            $errors[] = "Last Name Field Is Empty";
        }
        if(empty(trim($_POST['username']))){
            $errors[] = "User Name Field Is Empty";
        }
        if(empty(trim($_POST['email']))){
            $errors[] = "Email Field Is Empty";
        }
        if(empty(trim($_POST['phonenumber']))){
            $errors[] = "Phone Number Field Is Empty";
        }
        if(empty(trim($_POST['password']))){
            $errors[] = "Password Field Is Empty";
        }
        if(empty(trim($_POST['cpassword']))){
            $errors[] = "Confirm Password Field Is Empty";
        }

        //checking maximum characters 
        $fields_limit = array('firstname'=> 80,'lastname'=>90,'username'=>20,'email'=>200,"phonenumber"=>15,'password'=>12,'cpassword'=>12);

        foreach ($fields_limit as $fields => $limit) {
           if(strlen($_POST[$fields]) > $limit){
            $errors[] = $fields . "Must Be Less Than " . $limit . "Characters";
           }
        }

        //checking email
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $errors[] = "Please Input Valid Email Address";
        }

        //checking password and conform password
        if($_POST['password'] != $_POST['cpassword']){
            $errors[] = "Confirm Password Is Invalid";
        }

        //checking email has already used?
        $email_check_query = "SELECT email FROM student WHERE email = '{$email}' LIMIT 1";
        $result_email_ceck = mysqli_query($connection, $email_check_query);

       if($result_email_ceck){
            if(mysqli_num_rows($result_email_ceck)==1){
                 $errors[] = "This Email Is All Ready Entered";
            }
           
        }
        else{
            print_r(mysqli_error($connection));
        }

        //if empty errors
        if(empty($errors)){

            //generate student id
            $student_id_query = "SELECT st_id FROM student ORDER BY st_id DESC LIMIT 1";
            $result_student_id = mysqli_query($connection,$student_id_query);

            if($result_student_id){
                $last_st_id = mysqlI_fetch_assoc($result_student_id);

                if ($last_st_id['st_id'] == "") {
                    $st_id = "st1";
                    echo "$st_id";
                }
                else{
                    $last_id = substr($last_st_id['st_id'],2);
                    $new_st_id = ++$last_id;
                    $st_id = "st" . $new_st_id;
                }

            }
            else{
                print_r(mysqli_error($connection));
            }


            //inserting Values to database

            $firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
            $lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
            $username = mysqli_real_escape_string($connection,$_POST['username']);
            $email = mysqli_real_escape_string($connection,$_POST['email']);
            $phonenumber = mysqli_real_escape_string($connection,$_POST['phonenumber']);
            $password = mysqli_real_escape_string($connection,$_POST['password']);

            $convert_password = sha1($password);

            $insert_query = "INSERT INTO student VALUES('{$st_id}','{$firstname}','{$lastname}','{$username}','{$email}','{$phonenumber}','{$convert_password}',0)";

            $insert_result = mysqli_query($connection,$insert_query);

            if($insert_result){
                echo "<script>";
                    echo "alert('Student Registered!')";
                echo "</script>";

                $firstname =     "";
                $lastname =      "";
                $username =      "";
                $email =         "";
                $phonenumber =   "";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <title>LankaE learn</title>
</head>
<body>

    <div class="container text-center mt-4">

        <h2>Sign Up</h2>
    </div>

        <?php  

            if(!empty($errors)){
                echo "<div class = 'errors'>";
                    foreach ($errors as $value) {
                        echo "<p>". $value ."</p>";
                    }
                echo "</div>";
            }

        ?>
        <div class="row mt-4">
            <div class="col-md-4"></div>
            <div class="col-md-4 ">
        <form action="signup.php" method="POST">
            <div class="form-group row">
                <label for="firstname" class="col-sm-4 col-form-label">First Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="firstname" name="firstname">
            </div>
            </div>
            <div class="form-group row">
                <label for="lastname" class="col-sm-4 col-form-label">Last Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="lastname" name="lastname">
            </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-sm-4 col-form-label">Username</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="username" name="username">
            </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="email" name="email">
            </div>
            </div>
            <div class="form-group row">
                <label for="phonenumber" class="col-sm-4 col-form-label">Phone No</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="phone_no" name="phonenumber">
            </div>
            </div>
            <div class="form-group row">
                <label for="password1" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password1" name="password">
                </div>
            </div>
            <div class="form-group row">
                <label for="password2" class="col-sm-4 col-form-label">Confirm Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password2" name="cpassword">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <input class="btn btn-primary" type="submit" name="submit" value="submit">
                </div>
            </div>
        </form> 
        </div> 
        <div class="col-md-4"></div>

        </div>  

    </div><!--main_container-->

</body>
<?php mysqli_close($connection); ?>
</html>
<?php include('inc/footer.php') ?>