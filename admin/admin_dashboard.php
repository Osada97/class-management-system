<?php include('../inc/admin_header.php') ?>
<?php require_once '../inc/connection.php'?>
<?php

$teacher = "select teacher_id from teacher";
$t_result = mysqli_query($connection,$teacher);
$t_count = mysqli_num_rows($t_result);
$student = "select st_id from student";
$s_result = mysqli_query($connection,$student);
$s_count = mysqli_num_rows($s_result);
$course = "select course_id from course";
$c_result = mysqli_query($connection,$course);
$c_count = mysqli_num_rows($c_result);
?>

<style>
    .card-title{
        color: #fff;
    }
</style>

      <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <div class="row">
            <div class="container">
                <div class="col-md-12 card-deck mt-4">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Courses</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Courses</h5>
                            <p class="card-text"><h3><?php echo $c_count; ?></h3></p>
                        </div>
                    </div>
                    <div class="card text-white bg-success mb-3 " style="max-width: 18rem;">
                        <div class="card-header">Teachers</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Teachers</h5>
                            <p class="card-text"><h3><?php echo $t_count; ?></h3></p>
                        </div>
                    </div>
                    <div class="card text-white bg-danger mb-3 " style="max-width: 18rem;">
                        <div class="card-header">Students</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Students</h5>
                            <p class="card-text"><h3><?php echo $s_count; ?></h3></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
<script src="https://kit.fontawesome.com/4f6c585cf2.js" crossorigin="anonymous"></script><!-- font awsome script -->   
  <?php include('../inc/admin_footer.php')?>

























