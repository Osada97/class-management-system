<?php ob_start(); ?>
<?php  require_once ('../inc/connection.php');?>
<?php session_start(); ?>

<?php  

    //checking sessions
    if(!isset($_SESSION['teacher_id'])){
        header('Location:../signin.php?err=true');
    }

?>

<?php  
    
    $errors = array();

    $course_name="";
    $enroll_key="";
    $description="";
    $course_image="";

    //when user press add button

    if(isset($_POST['add'])){

        $course_name=$_POST['course_name'];
        $enroll_key=$_POST['enroll_key'];
        $description=$_POST['description'];

        //form validataion

        if(empty(trim($_POST['course_name']))){
            $errors[] = "Course Name Field Is Empty";
        }
        if(strlen($_POST['course_name'])>100){
            $errors[] = "Courese Name Must Be Less Than 100 Characters";
        }

        //uploading picture

        if($_FILES['course_image']['name'] != ""){
            if($_FILES['course_image']['error'] ==0){

                if($_FILES['course_image']['size']/1024<500){

                    if($_FILES['course_image']['type']=='image/jpeg'){

                          $file_name = $_FILES['course_image']['name'];
                          $file_type = $_FILES['course_image']['type'];
                          $temp_name = $_FILES['course_image']['tmp_name'];

                          $upload_to = "../img/course_covers/";

                        if(empty($errors)){

                            $isimg = move_uploaded_file($temp_name,$upload_to . $file_name);

                            if($isimg){
                                $course_image = 1;
                            }
                            else{
                                 $course_image = 0;
                            }

                        }

                    }
                     else{
                        $errors[] = "File Type Must Be jpg";
                     }


                 }
                 else{
                    $errors[]= "Image Must Be Less Than 500kb";
                 }
            }
            else{
                $errors[]="This Image Can Not Upload";
            }

        }
        else{
            $course_image = 0;
            $file_name = "";
        }


        if(empty($errors)){

            //getting fields values
            $course_name = mysqli_real_escape_string($connection,$_POST['course_name']);

            if(!empty($_POST['enroll_key'])){
                $enroll_key = mysqli_real_escape_string($connection,$_POST['enroll_key']);
                $is_enrolled = 1;
            }
            else{
                $is_enrolled = 0;
            }
            $teacher_id = $_SESSION['teacher_id'];
            $description = mysqli_real_escape_string($connection,$_POST['description']);
            $course_type =$_POST['course_type'];
            $class_type = implode('/', $_POST['class_type']);

           //insert data into database
            $query = "INSERT INTO course(teacher_id,course_name,is_enrolled,enroll_key,course_img,img_name,description,course_type,class_type,date) VALUES({$teacher_id},'{$course_name}',{$is_enrolled},'{$enroll_key}',{$course_image},'{$file_name}','{$description}','{$course_type}','{$class_type}',current_date())";
            $result = mysqli_query($connection,$query);

            if($result){
                echo "OK";
                $course_name="";
                $enroll_key="";
                $description="";
                $course_image="";
            }   
            else{
                print_r(mysqLI_error($connection));
            }
        }


    }
    

?>


<?php include_once '../inc/header.php'; ?>
<?php include_once 'teacher_header.php'; ?>
<?php include_once 'tnav.php'; ?>

<div class="container">
    <h3 class="text-center mt-4 mb-4">Add Course</h3>

    <?php  

        //display errors
        if(!empty($errors)){
            echo "<div class='errors'>";
                foreach ($errors as $value) {
                    echo "<p>";
                        echo $value;
                    echo "<p>";
                }
            echo "</div>";
        }

    ?>
<form action="tcourse.php" method="POST" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Course Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" name="course_name" value="<?php echo($course_name) ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Enroll Key</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword3" name="enroll_key" value="<?php echo($enroll_key) ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Course Image</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="inputPassword3" name="course_image">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
            <textarea type="text" class="form-control" id="inputPassword3" name="description"><?php echo $description; ?></textarea>
        </div>
    </div>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Course Type</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="gridRadios1" value="a/l" name="course_type" checked>
                    <label class="form-check-label" for="gridRadios1">
                        A/L
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio"  id="gridRadios2" value="o/l" name="course_type">
                    <label class="form-check-label" for="gridRadios2">
                        O/L
                    </label>
                </div>

            </div>
        </div>
    </fieldset>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Class Type</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridRadios1" value="theory" name="class_type[]" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Theory
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="gridRadios2" value="revision" name="class_type[]">
                    <label class="form-check-label" for="gridRadios2">
                        Revision
                    </label>
                </div>

            </div>
        </div>
    </fieldset>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" name="add" class="btn btn-primary">Add Course</button>
        </div>
    </div>
</form>
</div>


<?php include_once 'teacher_footer.php'; ?>
