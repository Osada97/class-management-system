<?php require_once('../inc/connection.php'); ?>
<?php include ('../inc/admin_header.php')?>
<?php include ('../inc/adnav.php')?>

<?php

$errors = array();

$first_name ="";
$last_name ="";
$email = "";
$phone_number ="";

if(isset($_POST['submit'])){
    // if form is submit

    $first_name = $_POST["firstname"];
    $last_name = $_POST["lastname"];
    $email = $_POST["email"];
    $phone_number = $_POST["phonenumber"];


    // checking fields are empty or not
    if(empty(trim($_POST['firstname']))){
        $errors[] = "First Name Field Is Required";
    }
    if(empty(trim($_POST['lastname']))){
        $errors[] = "Last Name Field Is Required";
    }
    if(empty(trim($_POST['email']))){
        $errors[] = "Email Field Is Required";
    }
    if(empty(trim($_POST['phonenumber']))){
        $errors[] = "Phone Number Field Is Required";
    }
    if(empty(trim($_POST['password']))){
        $errors[] = "Password Field Is Required";
    }
    if(empty(trim($_POST['cpassword']))){
        $errors[] = "Confirm Password Field Is Required";
    }

    //checking input fields length

    $length = array("firstname"=>30,"lastname"=>50,"email"=>100,"phonenumber"=>12,"password"=>12,"cpassword"=>12);

    foreach ($length as $field => $value) {
        if(strlen($_POST[$field]) > $value){
            $errors[] = $field . "Must Be Less Than " . $value . " Charcters";
        }
    }

    //checking confirm password and password are same
    if($_POST['password'] != $_POST['cpassword']){
        $errors[] = "Confirm Password Is Invalid";
    }

    // checking user entered valid email or not
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $errors[] = "Please Input Valid Email Address";
    }

    //checking email is already Exists
    $email = $_POST['email'];

    $checkEquery = "SELECT * FROM teacher WHERE email = '{$email}' LIMIT 1";
    $email_result = mysqli_query($connection,$checkEquery);

    if($email_result){
        if(mysqli_num_rows($email_result)!=0){
            $errors[] = "Email Is Already Exists";
        }
        else{
            //checking student table emails
            $checkSTquery = "SELECT * FROM student WHERE email = '{$email}' LIMIT 1";
            $email_result = mysqli_query($connection,$checkSTquery);

            if($email_result){
                if(mysqli_num_rows($email_result)!=0){
                    print_r(mysqli_num_rows($email_result));
                    $errors[] = "Email Is Already Exists";
                }
                else{
                    //checking admin table
                    $checkADquery = "SELECT * FROM admin WHERE email = '{$email}' LIMIT 1";
                    $email_result = mysqli_query($connection,$checkADquery);

                    if($email_result){
                        if(mysqli_num_rows($email_result) != 0){
                            $errors[] = "Email Is Already Exists";
                        }
                    }
                }
            }

        }
    }

    //if empty errors

    if(empty($errors)){

        $first_name = mysqli_real_escape_string($connection,$_POST['firstname']);
        $last_name = mysqli_real_escape_string($connection,$_POST['lastname']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $phone_number = mysqli_real_escape_string($connection,$_POST['phonenumber']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);

        $enc_password = sha1($password);

        //insert value to database
        $insert_query = "INSERT INTO teacher(first_name,last_name,email,phone_number,password,freez) VALUES('{$first_name}','{$last_name}','{$email}','{$phone_number}','{$enc_password}',0)";
        $result = mysqli_query($connection,$insert_query);

        if($result){
            echo "<script>";
            echo "alert('{$first_name} Registered')";
            echo "</script>";
            /*
              ?email can send in here
            */

        }
        else{
            print_r(mysqli_error($connection));
        }
    }

}

?>


<div class="container-fluid">
    <h1 class="mt-4">Add Teacher</h1>

    <!-- show eroors  -->
    <?php
    if(!empty($errors)){

        echo "<div class='errors'>";
        foreach ($errors as $err){
            echo "<p>";
            echo $err;
            echo "</p>";
        }
        echo "</div>";

    }

    ?>


    <div class="container">
        <form class="needs-validation" novalidate action="addteacher.php" method="POST">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom01">First name</label>
                    <input type="text" name="firstname" class="form-control" id="validationCustom01" value="<?php echo $first_name; ?>" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Last name</label>
                    <input type="text" name="lastname" class="form-control" id="validationCustom02" value="<?php echo $last_name; ?>" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Email</label>
                    <input type="email" name="email" class="form-control" id="validationCustom02" value="<?php echo $email; ?>" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom03">Phone No</label>
                    <input type="text" class="form-control" id="validationCustom03" name="phonenumber" value ="<?php echo $phone_number; ?>" required>
                    <div class="invalid-feedback">
                        Please provide a valid Phone No
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="validationCustom03">Password</label>
                    <input type="password" name="password" class="form-control"  id="validationCustom03" required>
                    <div class="invalid-feedback">
                        Password filed is required!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom03">confirm password</label>
                    <input type="password" name="cpassword" class="form-control" id="validationCustom03" required>
                    <div class="invalid-feedback">
                        Please Check Your Password
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" type="submit" name="submit">Sign Up</button>
        </form>
    </div>
</div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
<script src="https://kit.fontawesome.com/4f6c585cf2.js" crossorigin="anonymous"></script><!-- font awsome script -->
    <?php include_once ("../inc/admin_footer.php");?>


