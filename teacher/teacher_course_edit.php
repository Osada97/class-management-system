<?php ob_start(); ?>
<?php session_start(); ?>
<?php include_once '../inc/header.php'; ?>
<?php include_once 'teacher_header.php'; ?>
<?php include_once 'tnav.php'; ?>
<?php require_once ('../inc/connection.php'); ?>

<?php  

    if(!isset($_SESSION['teacher_id'])){
        header("Location:../signin.php");
    }
    if(!isset($_GET['course_id'])){
        header("Location:../signin.php");   
    }

    //retrieve curse details
    $course_id = $_GET['course_id'];
    $course_name="";
    $enroll_key="";
    $description="";

    $re_query = "SELECT * FROM course WHERE course_id={$course_id} LIMIT 1";
    $re_result = mysqli_query($connection,$re_query);

    if($re_result){
        if(mysqli_num_rows($re_result)==1){
            $re_det = mysqli_fetch_assoc($re_result);
        }
    }

    $errors = array();

    if(isset($_POST['update'])){

        $course_id = $_GET['course_id'];
        $course_name = mysqli_real_escape_string($connection,$_POST['course_name']);
        $enroll_key = mysqli_real_escape_string($connection,$_POST['enroll_key']);
        $description = mysqli_real_escape_string($connection,$_POST['description']);

        //form validation
        if(empty(trim($course_name))){
            $errors[] = 'Corse Name Field Is Empty';
        }
        if($re_det['is_enrolled'] == 1){  
            if(empty(trim($enroll_key))){
                $errors[] = 'Enroll Key Is Empty';
            }
            else{
                $is_enrolled = 1;
            }
        }
         else{
            if(!empty(trim($enroll_key))){
                $is_enrolled = 1;
            }
            else{
                $is_enrolled =0;
            }
         }

        //checking fields length
        if(strlen($course_name) > 100){
            $errors[] = "Course Name Must Be 100 Characters";
        }
        if(strlen($enroll_key) > 100){
            $errors[] = "Enroll Key Must Be 100 Characters";
        }


        //file uploading
        if ($_FILES['course_image']['name'] != "") {
            if ($_FILES['course_image']['error'] == 0) {

                if ($_FILES['course_image']['size'] / 1024 < 500) {

                    if ($_FILES['course_image']['type'] == 'image/jpeg') {

                        $file_name = $_FILES['course_image']['name'];
                        $file_type = $_FILES['course_image']['type'];
                        $temp_name = $_FILES['course_image']['tmp_name'];

                        $upload_to = "../img/course_covers/";

                        if (empty($errors)) {

                            $isimg = move_uploaded_file($temp_name, $upload_to . $file_name);

                            if ($isimg) {
                                $query = "UPDATE course SET course_img = 1,img_name = '{$file_name}' WHERE course_id = {$course_id}";
                                $result = mysqli_query($connection,$query);
                                if($result){

                                }
                                else{
                                    print_r(mysqli_error($connection));
                                }
                            }
                        }

                    } else {
                        $errors[] = "File Type Must Be jpg";
                    }


                } else {
                    $errors[] = "Image Must Be Less Than 500kb";
                }
            } else {
                $errors[] = "This Image Can Not Upload";
            }

        }

        if(empty($errors)){
            $type = $_POST['class_type'];
            $class_type = implode('/', $type);
            $course_type = $_POST['course_type'];

            $up_query = "UPDATE course SET course_name = '{$course_name}',enroll_key='{$enroll_key}',is_enrolled = {$is_enrolled},description='{$description}',course_type='{$course_type}',class_type='{$class_type}' WHERE course_id = {$course_id}";
            $up_result = mysqli_query($connection,$up_query);

            if($up_result){
                echo "<script>";
                    echo "alert('Course Updated')";
                echo "</script>";
                header('Location:teacher_dashboard.php');
            }
        }


    }

?>

<div class="container">
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
<form action="teacher_course_edit.php?course_id=<?php echo $course_id ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Course Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" name="course_name"
                   value="<?php echo $re_det['course_name'] ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Enroll Key</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword3" name="enroll_key"
                   value="<?php echo $re_det['enroll_key'] ?>">
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
                <textarea type="text" class="form-control" id="inputPassword3"
                          name="description"><?php echo $re_det['description'] ?></textarea>
        </div>
    </div>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Course Type</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="gridRadios1" value="a/l" name="course_type"
                           <?php if($re_det['course_type'] == 'a/l'){ echo "checked=checked";} ?>>
                    <label class="form-check-label" for="gridRadios1">
                        A/L
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="gridRadios2" value="o/l" name="course_type" <?php if($re_det['course_type'] == 'o/l'){ echo "checked=checked";} ?>>
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
                    <input class="form-check-input" type="checkbox" id="gridRadios1" value="theory"
                           name="class_type[]" <?php if($re_det['class_type'] == 'theory/revision'){ echo "checked=checked";}
                           else if ($re_det['class_type'] == 'theory'){echo "checked=checked";} ?> >
                    <label class="form-check-label" for="gridRadios1">
                        Theory
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridRadios2" value="revision"
                           name="class_type[]" <?php if($re_det['class_type'] == 'theory/revision'){ echo "checked=checked";}else if ($re_det['class_type'] == 'revision'){echo "checked=checked";} ?> >
                    <label class="form-check-label" for="gridRadios2">
                        Revision
                    </label>
                </div>

            </div>
        </div>
    </fieldset>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" name="update" class="btn btn-primary">Update Course</button>
        </div>
    </div>
</form>
</div>

<?php include_once ("teacher_footer.php");