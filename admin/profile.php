<?php ob_start() ?>
<?php include('../inc/admin_header.php') ?>
<?php require_once ('../inc/connection.php');?>

<?php

if(!isset($_SESSION['admin_id'])){
    header("Location:../signin.php");
}
else{
    $admin_id = $_SESSION['admin_id'];

    $admin_name="";
    $email="";

    $query = "SELECT * FROM admin WHERE admin_id = {$admin_id} LIMIT 1";
    $result = mysqli_query($connection,$query);

    if($result){
        if(mysqli_num_rows($result) == 1){

            $prode = mysqli_fetch_assoc($result);
        }
        else{
            header("Location:../signin.php");
        }
    }
    else{
        print_r(mysqli_error($connection));
    }

}

?>

<?php

$error = array();

//update profile goes in here
if (isset($_POST['update'])) {

    $admin_name = mysqli_real_escape_string($connection,$_POST['admin_name']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);

    //form validation
    if(empty(trim($admin_name))){
        $error[] = "First Name Field Is Empty";
    }
    if(empty(trim($email))){
        $error[] = "Email Field Is Empty";
    }

    $fields_len = array("admin_name" => 100,"email"  => 100);

    foreach ($fields_len as  $len => $length) {
        if(strlen($_POST[$len]) > $length){
            $error[] = $len . "Field Must Be Less Than " . $length . "Charters";
        }
    }

    //email validation
    if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !empty(trim($email))){
        $error[] = "Please Enter Valid Email";
    }

    //checking enter email is already used
    $query = "SELECT * FROM admin WHERE email = '{$email}' AND admin_id != {$admin_id}";
    $result_set = mysqli_query($connection,$query);

    if($result_set){
        if(mysqli_num_rows($result_set) != 0){
            $error[] = "This Email Is already Entered";
        }
        else{
            $query = "SELECT * FROM student WHERE email = '{$email}'";
            $result_set = mysqli_query($connection,$query);

            if($result_set){
                if(mysqli_num_rows($result_set) != 0){
                    $error[] = "This Email Is already Entered";
                }
                else{
                    $query = "SELECT * FROM teacher WHERE email = '{$email}'";
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
    if ($_FILES['adminpic']['name'] != "") {
        if ($_FILES['adminpic']['error'] == 0) {

            if ($_FILES['adminpic']['size'] / 1024 < 500) {

                if ($_FILES['adminpic']['type'] == 'image/jpeg') {

                    $file_name = $_FILES['adminpic']['name'];
                    $file_type = $_FILES['adminpic']['type'];
                    $temp_name = $_FILES['adminpic']['tmp_name'];

                    $upload_to = "../img/admin_pic/";

                    if (empty($error)) {

                        $isimg = move_uploaded_file($temp_name, $upload_to . $file_name);

                        if ($isimg) {
                            $is_tc_image = 1;
                            $query = "UPDATE admin SET is_image = 1,img_name ='{$file_name}' WHERE admin_id = {$admin_id}";
                            $result = mysqli_query($connection,$query);
                        }

                    }

                } else {
                    $error[] = "File Type Must Be jpg";
                }


            }
            else {
                $error[] = "Image Must Be Less Than 500kb";
            }
        }
        else {
            $error[] = "This Image Can Not Upload";
        }
    }


    if(empty($error)){

        $in_query = "UPDATE admin SET admin_name = '{$admin_name}',email='{$email}' WHERE admin_id = {$admin_id} ";
        $result_in = mysqli_query($connection,$in_query);

        if($result_in){
            echo "<script>";
            echo "alert('Profile Updated!')";
            echo "</script>";
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

            $query_pw = "SELECT * FROM admin WHERE admin_id={$admin_id} AND password='{$shaPassword}' LIMIT 1";
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

            $uppw_query = "UPDATE admin SET password = '{$shhpassword}' WHERE admin_id={$admin_id} LIMIt 1";
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
            $query_dl_us = "DELETE FROM admin WHERE admin_id ={$admin_id} AND password='{$shapass}' LIMIT 1";
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



<!-- styles goes in here -->
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
    .skiils{
        margin-bottom: 10px;

    }
    .pr_skills{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    .sparent input{
        width: 100px;
        margin: 8px;
        border: none;
        outline: none;
        display: inline-block;
        font-size: 12px;
        padding: 5px;
        pointer-events: none;
    }
    .sparent button{
        border: none;
        outline: none;
        background-color: orange;
        color: #fff;
        font-size: 12px;
        padding: 5px;
        margin-left: -8px;
    }
    .sparent button i{
        pointer-events: none;
    }
    .sk{
        transition: 0.5s;
    }
    #recipient-skills{
        width: 90%;
        display: inline;
    }
    #add{
        display: inline;
        width: 7%;
        font-size: 14px;
    }
    #add:hover i{
        animation: 1s ro linear;
    }
    @keyframes ro{
        form{
            transform: rotateZ(0deg);
        }
        to{
            transform: rotateZ(360deg);
        }
    }
    .trh{
        transform: translateY(20px);
        opacity: 0;
        pointer-events: none;
        transition: 0.5s;
    }
</style>

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
        <h1 class="display-4"><?php echo $prode['admin_name']; ?></h1>
        <?php
        //grtting image
        if($prode['is_image'] != 0){
            if($prode['img_name'] != null){
                echo "<img src='../img/admin_pic/{$prode['img_name']}' alt='Profile pic' class='rounded-circle' style='width: 200px; height: 200px'>";
            }
            else{
                echo '<img src="../img/admin.png" alt="Profile pic" class="rounded-circle" style="width: 200px; height: 200px">';
            }
        }
        else{
            echo '<img src="../img/admin.png" alt="Profile pic" class="rounded-circle" style="width: 200px; height: 200px">';
        }

        ?>

        <p class="lead">profile id:- 0<?php echo $admin_id; ?></p>
    
        <hr class="my-4">
        
        <div class="row justify-content-center" >
            <div class="card border-info mb-3" style="max-width: 18rem; margin-right: 20px" >
                <div class="card-header">Total Courses</div>
                <div class="card-body text-info">
                    <h1 class="card-title">
                        <?php  
                            $query_get="SELECT count(course_id) AS to_coursse FROM course";
                            $result = mysqli_query($connection,$query_get);

                            $to = mysqli_fetch_assoc($result);
                            echo $to['to_coursse'];

                        ?>
                    </h1>

                </div>
            </div>
            <div class="card border-info mb-3" style="max-width: 18rem; margin-right: 20px">
                <div class="card-header">Total Students</div>
                <div class="card-body text-info">
                    <h1 class="card-title">
                        <?php  
                            $query_get="SELECT count(st_id) AS to_student FROM student";
                            $result = mysqli_query($connection,$query_get);

                            $to = mysqli_fetch_assoc($result);
                            echo $to['to_student'];

                        ?>
                    </h1>

                </div>
            </div>
            <div class="card border-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Total Teachers</div>
                <div class="card-body text-info">
                    <h1 class="card-title">
                        <?php  
                            $query_get="SELECT count(teacher_id) AS to_teacher FROM teacher";
                            $result = mysqli_query($connection,$query_get);

                            $to = mysqli_fetch_assoc($result);
                            echo $to['to_teacher'];

                        ?>
                    </h1>

                </div>
            </div>
        </div>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#exampleModal">Edit Profile</a>
        </p>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="recipient-name" class="col-form-label">Admin Name</label>
                        <input type="text" class="form-control" id="recipient-name" name="admin_name" value="<?php echo($prode['admin_name']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="recipient-email" name="email" value="<?php echo($prode['email']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Change Profile Picture</label>
                        <input type="file" class="form-control" id="profile-pic" name="adminpic">
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
                            <button type="submit" class="btn btn-primary" name="delete_account">Delete My Account</button>
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


<?php include_once '../inc/admin_footer.php';?>

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
