<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once ('../inc/connection.php'); ?>

<?php  
    
    if(!isset($_SESSION['student_id'])){
        header('Location:../signin.php?false');
    }
    else{
        $student_id = $_SESSION['student_id'];
    }

?>

<?php  

    //getting student details to show 

    $query_st = "SELECT * FROM student WHERE st_id = '{$student_id}' AND freez=0 LIMIT 1";
    $result_st = mysqli_query($connection,$query_st);

    if($result_st){
        if(mysqli_num_rows($result_st)==1){
            $student_de = mysqli_fetch_assoc($result_st);
        }
    }
?>

<?php  

    //profile update goes in here 
    $error = array();
    if(isset($_POST['update'])){

        if(empty(trim($_POST['first_name']))){
            $error[] = "First Name Field Is Empty";
        }
        if(empty(trim($_POST['last_name']))){
            $error[] = "Last Name Field Is Empty";
        }
        if(empty(trim($_POST['user_name']))){
            $error[] = "User Name Field Is Empty";
        }
        if(empty(trim($_POST['email']))){
            $error[] = "Email Field Is Empty";
        }

        if(strlen($_POST['first_name']) > 50){
            $error[] = "First Name Must Be Less Than 50 Characters";
        }
        if(strlen($_POST['last_name']) > 60){
            $error[] = "Last Name Must Be Less Than 60 Characters";
        }
        if(strlen($_POST['email']) > 200){
            $error[] = "Email Must Be Less Than 200 Characters";
        }
        if(strlen($_POST['phone_number']) > 12){
            $error[] = "Phone Number Must Be Less Than 12 Characters";
        }

        //email validation
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) && !empty(trim($_POST['email']))){
            $error[] = "Please Enter Valid Email";
        }

        //checking Email Has Already Used In Other Accounts
        $query = "SELECT * FROM teacher WHERE email = '{$_POST['email']}'";
        $result_set = mysqli_query($connection,$query);

        if($result_set){
            if(mysqli_num_rows($result_set) != 0){
                $error[] = "This Email Is already Entered";
            }
            else{
                $query = "SELECT * FROM student WHERE email = '{$_POST['email']}' AND st_id != '{$student_id}'";
                 $result_set = mysqli_query($connection,$query);

                 if($result_set){
                    if(mysqli_num_rows($result_set) != 0){
                        $error[] = "This Email Is already Entered";
                    }
                    else{
                        $query = "SELECT * FROM admin WHERE email = '{$_POST['email']}'";
                        $result_set = mysqli_query($connection,$query);

                         if($result_set){
                            if(mysqli_num_rows($result_set) != 0){
                                $error[] = "This Email Is already Entered";
                            }
                        }
                    }
                 }
            }
        }

        //uploading profile picture
        if($_FILES['studentpic']['name'] != ""){
            if($_FILES['studentpic']['error'] == 0){

                if($_FILES['studentpic']['size']/1024 <500){
                    if($_FILES['studentpic']['type'] == 'image/jpeg'){

                        $filename   =$_FILES['studentpic']['name'];
                        $filetype   =$_FILES['studentpic']['type'];
                        $temp_name  =$_FILES['studentpic']['tmp_name'];

                        $upload_to ="../img/student_pic/";

                        if(empty($error)){
                            $isimg = move_uploaded_file($temp_name, $upload_to . $filename);

                            if($isimg){
                                $up_query = "UPDATE student SET is_image = 1,img_name = '{$filename}' WHERE st_id = '{$student_id}'";
                                $result_up = mysqli_query($connection,$up_query);

                            }
                        }
                    }
                    else{
                        $error[] = "This Image Type Is Invalid";
                    }
                }
                else{
                    $error[] = "Image Must Be Less Than 500KB";
                }
            }
            else{
                $error[] = "Can Not Upload This Picture";
            }
        }

        //updating student table
        if(empty($error)){
            $first_name = mysqli_real_escape_string($connection,$_POST['first_name']);
            $last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
            $user_name = mysqli_real_escape_string($connection,$_POST['user_name']);
            $email = mysqli_real_escape_string($connection,$_POST['email']);
            $phone_number = mysqli_real_escape_string($connection,$_POST['phone_number']);
            $bio = mysqli_real_escape_string($connection,$_POST['bio']);

            $uda_query = "UPDATE student SET first_name = '{$first_name}',last_name ='{$last_name}',user_name = '{$user_name}',email='{$email}',phone_number='{$phone_number}',bio='{$bio}' WHERE st_id ='{$student_id}'";
            $result_uda = mysqli_query($connection,$uda_query);

            if($result_uda){
                header("Location:profile.php");
            }
                  
        }

    }

?>

<?php  

    //changed Password Form Validation
    if(isset($_POST['save'])){

        if(empty(trim($_POST['cpassword']))){
            $error[] = "Current Password Field Is Empty";
        }
        if(empty(trim($_POST['npassword1']))){
            $error[] = "New Password Field Is Empty";
        }
        if(empty(trim($_POST['npassword2']))){
            $error[] = "Confirm Password Field Is Empty";
        }

        if(strlen($_POST['cpassword'])>12){
            $error[] = "Current Password Must Be Less Than 12 Characters";
        }
        if(strlen($_POST['npassword1'])>12){
            $error[] = "New Password Must Be Less Than 12 Characters";
        }
        if(strlen($_POST['npassword2'])>12){
            $error[] = "Confirm Password Must Be Less Than 12 Characters";
        }

        //checking current password is right 

        //if there is no errors
        if(!empty(trim($_POST['cpassword'])) && empty($error)){
            $password = mysqli_real_escape_string($connection,$_POST['cpassword']);
            $shaPassword = sha1($password);

            $query_pw = "SELECT * FROM student WHERE st_id='{$student_id}' AND password='{$shaPassword}' LIMIT 1";
            $result_pw = mysqli_query($connection,$query_pw);


            if(mysqli_num_rows($result_pw)==0){
                $error[] = "Current Password Is Invalid";
            }
        }

        //check new password and current password is same
        if($_POST['npassword1'] != $_POST['npassword2']){
            $error[] = 'Confirm password Is Invalid';
        }

        /*if thre is no errors*/
        if(empty($error)){
            $conpassword = mysqli_real_escape_string($connection,$_POST['npassword2']);
            $shhpassword = sha1($conpassword);

            $uppw_query = "UPDATE student SET password = '{$shhpassword}' WHERE st_id='{$student_id}' LIMIt 1";
            $result_uppw = mysqli_query($connection,$uppw_query);

            if($result_uppw){
                echo "<script>";
                    echo "alert('Password Changed')";
                echo "</script>";
            }
        }
    }

    //delete account

    if(isset($_POST['delete_account'])){
        if(empty(trim($_POST['cdlpassword']))){
            $error[] = "Password Field Is Empty";
        }
        if(strlen($_POST['cdlpassword'])>12){
            $error[] = "Password Must Be Less Than 12 Characters";
        }

        if(empty($error)){
            $password = mysqli_real_escape_string($connection,$_POST['cdlpassword']);
            $shapass =sha1($password);
            $query_dl_us = "DELETE FROM student WHERE st_id ='{$student_id}' AND password='{$shapass}' LIMIT 1";
            $result_dl_us = mysqli_query($connection,$query_dl_us);

            if($result_dl_us){
                echo "<script>";
                    echo "alert('Your Account Successfully Deleted')";
                echo "</script>";
                header("location:../index.php");
            }
        }
    }

?>



<!-- styling goes in here -->
<style>
    .container{
        position: relative;
    }
    .errors{
        position: absolute;
        width: 400px;
        border: 1px solid #ff4040;
        box-shadow: 1px 10px 12px 0px #ff9e9e4a;
        padding: 5px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #fffffff2;
        transition: 0.5s;
    }
    .errors .close,.err_content{
        width: 100%;
    }
    .errors .close{
        text-align: right;
    }
    .errors .close button{
        outline: none;
        cursor: pointer;
        font-size: 14px;
        border: none;
        background: none;
    }
    .errors .err_content{
        font-size: 14px;
        color: #8f2828;
    }
    .erhide{
        opacity: 0;
    }
    @media screen and (max-width: 500px) {
        .errors{
            width: 90%;
        }
    }

    /* styling for change password and delete account */
    .drbtn{
        background: none;
        outline: none;
        margin-left: 15px;
        border: none;
        color: red;
        font-size: 18px;
    }
    .dl_drop{
        display: none;
    }
    .chnagepas,.deleteus{
        margin-bottom: 25px;
        font-size: 18px;
        color: #ff7979;
    }
</style>

<?php include_once ('stu_header.php'); ?>


<div class="container text-center">

    <?php  

        if(!empty($error)){
            echo ' <div class="errors" id="errors">';
                echo '<div class="close">';
                    echo '<button type="button" id="close"><i class="fas fa-times"></i></button>';
                echo '</div>';
                echo '<div class="err_content">';
                    foreach ($error as $value) {
                        echo "<p>";
                            echo $value;
                        echo "</p>";
                    }
                echo "</div>";
            echo "</div>";
        }

    ?>

    <div class="jumbotron">
        <h1 class="display-4"><?php echo $student_de['first_name']," ",$student_de['last_name']; ?></h1>
        
        <?php  

            //dynamically set profile picture
            if($student_de['is_image'] !=0){
                if($student_de['img_name'] != null){
                    echo "<img src='../img/student_pic/{$student_de['img_name']}' alt='Profile pic' class='rounded-circle' style='width: 200px; height: 200px'>";
                }
                else{

                    echo "<img src='../img/defaultstudent.png' alt='Profile pic' class='rounded-circle' style='width: 200px; height: 200px'>";
                }
            }
            else{
                echo "<img src='../img/defaultstudent.png' alt='Profile pic' class='rounded-circle' style='width: 200px; height: 200px'>";
            }

        ?>
        <!-- <img src="../img/defaultteacher.png" alt='Profile pic' class='rounded-circle' style='width: 200px; height: 200px'> -->


        <p class="lead">profile id:- <?php echo $student_de['st_id']; ?></p>

        <hr class="my-4">
        <p><?php echo $student_de['bio']; ?></p>
        <hr class="my-4">
        <div class="row justify-content-center">
            <div class="card border-info mb-3" style="max-width: 18rem; margin-right: 20px">
                <div class="card-header">Courses I Enrolled</div>
                <div class="card-body text-info">
                    <h1 class="card-title">
                        <?php  
                            $query = "SELECT count(course_id) AS 'course_id' FROM course_enroll WHERE student_id = '{$student_id}'";
                            $resul = mysqli_query($connection,$query);

                            if($resul){
                                $count = mysqli_fetch_assoc($resul);
                                echo $count['course_id'];
                            }
                        ?>
                    </h1>

                </div>
            </div>

            <div class="card border-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Number of Learning</div>
                <div class="card-body text-info">
                    <h1 class="card-title">3</h1>

                </div>
            </div>
        </div>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#exampleModal">Edit
                Profile</a>
        </p>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Profile Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="profile.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="recipient-name" name="first_name" value="<?php echo $student_de['first_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="recipient-name" name="last_name" value="<?php echo $student_de['last_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">User Name</label>
                        <input type="text" class="form-control" id="recipient-name" name="user_name" value="<?php echo $student_de['user_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="recipient-email" name="email" value="<?php echo $student_de['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="col-form-label">Phone Number</label>
                        <input type="text" class="form-control" id="recipient-email" name="phone_number" value="<?php echo $student_de['phone_number'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Change Profile Picture</label>
                        <input type="file" class="form-control" id="profile-pic" name="studentpic">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Profile Bio</label>
                        <textarea class="form-control" id="message-text"
                                  name="bio"><?php echo($student_de['bio']) ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update">Update Profile</button>

                        <button type="button" class="btn btn-primary" name="update" data-toggle="modal" data-target="#password" data-dismiss="modal" style="float: left">Advanced</button>


                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password and Account Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="profile.php" method="POST">
                        <label for="cp" class="chnagepas">Change Password</label>
                        <button type="button" class="drbtn" id="cp"><i class="fas fa-caret-down"></i></button>
                        
                        <div class="cp_drop">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Current Password</label>
                                <input type="password" class="form-control" id="recipient-name" name="cpassword" >
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">New Password</label>
                                <input type="password" class="form-control" id="recipient-name" name="npassword1" >

                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="recipient-name" name="npassword2" >

                            </div>
                            <button type="submit" class="btn btn-primary" name="save">Save changes</button>
                        </div>
                    </form>
                    <form action="profile.php" method="POST">
                        <label for="dl"  class="deleteus">Delete Account</label>
                        <button type="button" class="drbtn" id="dl"><i class="fas fa-caret-down"></i></button>

                        <div class="dl_drop">
                            <p>If You Want To Delete Account Permanently, Please Input Password And Click "Delete My Account" Button.</p>
                            <p>When You Delete Your Account You Can Not Recover This Account.</p>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Password</label>
                                <input type="password" class="form-control" id="recipient-name" name="cdlpassword" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="delete_account">Delete Account</button>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

<script src="https://kit.fontawesome.com/4f6c585cf2.js" crossorigin="anonymous"></script>

<script>
    //errors
    const close = document.querySelector('#close');
    const errors= document.querySelector('#errors');
    const body = document.querySelector('body');
    close.addEventListener('click',function(){
        errors.classList.add('erhide');

        errors.addEventListener('transitionend',function(){
            errors.style.display = "none";
        });
    });
    body.addEventListener('click',function(){
        errors.classList.add('erhide');
        errors.addEventListener('transitionend',function(){
            errors.style.display = "none";
        });
    });
</script>
<?php include "stu_footer.php"; ?>
<script>
    //slide change password delete account

    $(document).ready(function(){

        $('#cp').click(function(){
            $('.cp_drop').slideToggle();
            $('.dl_drop').slideToggle();;
        });
        $('#dl').click(function(){
            $('.cp_drop').slideToggle();
            $('.dl_drop').slideToggle();;
        });
    });

</script>
