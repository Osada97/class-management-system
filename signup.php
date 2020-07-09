<?php include('inc/header.php')?>

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
            $errors[] = "This Email Is All Ready Entered";
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

    <div class="main_container">

        <h2>Sign Up</h2>

        <?php  

            if(!empty($errors)){
                echo "<div class = 'errors'>";
                    foreach ($errors as $value) {
                        echo "<p>". $value ."</p>";
                    }
                echo "</div>";
            }

        ?>

        <form action="signup.php" method="POST">
            <p>
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" autofocus value="<?php echo($firstname) ?>">
            </p>
            <p>
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo($lastname) ?>">
            </p>
            <p>
                <label for="username">User Name:</label>
                <input type="text" name="username" id="username" value="<?php echo($username) ?>">
            </p>
            <p>
                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email" value="<?php echo($email) ?>">
            </p>
            <p>
                <label for="phonenumber">Phone Number:</label>
                <input type="text" name="phonenumber" id="phonenumber" value="<?php echo($phonenumber) ?>">
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </p>
            <p>
                <label for="cpassword">Confirm Password:</label>
                <input type="password" name="cpassword" id="cpassword">
            </p>
            <input type="submit" name="submit" value="submit">
        </form>    

    </div><!--main_container-->

</body>
<?php mysqli_close($connection); ?>
</html>
<?php include('inc/footer.php')?>