<?php require_once('../inc/connection.php'); ?>
<?php require_once('../inc/header.php'); ?>


<?php

    $errors = array();

    if(isset($_POST['submit'])){

        if(empty(trim($_POST['admin_name']))){
            $errors[] = "Please Input Admin Name";
        }
        if(empty(trim($_POST['email']))){
            $errors[] = "Please Input Admin's Email";
        }
        if(empty(trim($_POST['password']))){
            $errors[] = "Please Input Password";
        }

        $field_len = array('admina_name' =>30,'email' =>100,'password'=>12);

        foreach($field_len as $fields => $len){
            if(strlen($fields) > $len){
                $errors[] = $fields . "Must Be Less Than " . $len . "Characters";
            }
        }

        //checking email is valid one
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty(trim($_POST['email']))){
            $errors[] = "Please Enter Valid Email";
        }

        //checking email
        $ck_ad_query ="SELECT * FROM admin WHERE email = '{$_POST['email']}' LIMIT 1";
        $result_ck_ad = mysqli_query($connection,$ck_ad_query);

        if($result_ck_ad){
            if(mysqli_num_rows($result_ck_ad)!=0){
                $errors[] = "Email Is Already Added";
            }
            else{
                //checking email is already added in student table
                $ck_ad_query ="SELECT * FROM student WHERE email = '{$_POST['email']}' LIMIT 1";
                $result_ck_ad = mysqli_query($connection,$ck_ad_query);

                if($result_ck_ad){
                    if(mysqli_num_rows($result_ck_ad)!=0){
                        $errors[] ="Email Is Already Added";
                    }
                    else{
                       //checking email is already added in student table
                        $ck_ad_query ="SELECT * FROM teacher WHERE email = '{$_POST['email']}' LIMIT 1";
                        $result_ck_ad = mysqli_query($connection,$ck_ad_query);

                        if($result_ck_ad){
                            if(mysqli_num_rows($result_ck_ad)!=0){
                                $errors[] ="Email Is Already Added";
                            }
                        } 
                    }
                }
            }
        }

        //if no errors
        if(empty($errors)){

            $admin_name = mysqli_real_escape_string($connection,$_POST['admin_name']);
            $email = mysqli_real_escape_string($connection,$_POST['email']);
            $password = mysqli_real_escape_string($connection,$_POST['password']);

            $em_password = sha1($password);

            $admin_in_query = "INSERT INTO admin(admin_name,email,password) VALUES('{$admin_name}','{$email}','{$em_password}')";
            $result_admin_in = mysqli_query($connection,$admin_in_query);

            if($result_admin_in){
                echo "<script>";
                    echo "alert('Admin {$admin_name} Is Successfully Added');";
                echo "</script>";
                /* 
                    !mail function goes in here
                */
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
    <title>LankaE learn</title>
</head>
<body>

    <div class="main_container">

        <?php
            if(!empty($errors)){
                echo "<div class='error'>";
                    foreach($errors as $err){
                        echo "<p>";
                            echo $err;
                        echo "</p>";
                    }
                echo "</div>";
            }
        ?>
        <div class="container col-md-6">
            <h1 class="mt-4 mb-4">Add Admins</h1>

            <form action="add_admins.php" method="POST">
<!--            <p>-->
<!--                <label for="admin_name">Admin Name:</label>-->
<!--                <input type="text" name="admin_name" id="admin_name">-->
<!--            </p>-->
<!--            <p>-->
<!--                <label for="email">Email:</label>-->
<!--                <input type="text" name="email" id="email">-->
<!--            </p>-->
<!--            <p>-->
<!--                <label for="password">Password:</label>-->
<!--                <input type="password" name="password" id="password">-->
<!--                <input type="button" name="show_hide" id="show_hide" value="show">-->
<!--            </p>-->
<!--            <input type="submit" value="Add Admin" name="submit">-->
<!--        </form>-->

                <div class="form-group">
                    <label for="admin_name">Admin Name</label>
                    <input type="text" class="form-control" name="admin_name" id="admin_name" aria-describedby="emailHelp" placeholder="Enter Admin Name">

                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control"  name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">


                        <span class="badge badge-warning"> <input type="button"   name="show_hide" id="show_hide" value="show"></span>

                </div>

                <button type="submit" class="btn btn-primary float-right">Add admin</button>
            </form>
        </div>
    </div>
    
        <script>
            //show and hide password
            let password = document.querySelector('#password');
            let showButton = document.querySelector('#show_hide');
            let hide = true;

                showButton.addEventListener('click' ,function(){
                    if(hide == true){
                        password.setAttribute('type','text');
                        showButton.setAttribute('value','hide');
                        hide=false;
                    }
                    else{
                        password.setAttribute('type','password');
                        showButton.setAttribute('value','show');
                        hide = true;
                    }
                });

        </script>
</body>
</html>