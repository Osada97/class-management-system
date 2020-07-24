<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once ('../inc/connection.php');?>
<?php include_once ('stu_header.php'); ?>

<?php  
    
    if(!isset($_SESSION['student_id'])){
        header('Location:../signin.php');
    }
    else{
        $student_id = $_SESSION["student_id"];

        $query = "SELECT * FROM course_enroll WHERE student_id = '{$student_id}'";
        $result = mysqli_query($connection,$query);

        if($result){
            if(mysqli_num_rows($result) >0){
                //display all courses
            }
            else{
                echo $student_id;
                header('refresh:3;url=dashboard.php');
            }
        }
        else{
            print_r(mysqli_error($connection));
        }
    }


?>


<div class="container">
    <div class="card-deck">
        <div class="card">
            <img src="../img/javascript.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>


            </div>
        </div>
        <div class="card">
            <img src="../img/javascript.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>

            </div>
        </div>
        <div class="card">
            <img src="../img/javascript.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>

            </div>
        </div>
    </div>
</div>


<?php include_once ('stu_footer.php'); ?>