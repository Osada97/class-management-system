<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once('../inc/connection.php') ?>
<?php include('./teacher_header.php') ?>
<?php include_once 'tnav.php';?>
<?php

//checking sessions
if(!isset($_SESSION['teacher_id'])){
    header('Location:../signin.php?err=true');
}

?>
<?php
$teacher_id = $_SESSION['teacher_id'];


$query = "SELECT * FROM course WHERE teacher_id = {$teacher_id} ORDER BY course_id DESC";

$result = mysqli_query($connection,$query);

$courses = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>

<div class="container">
<div class="card-deck">
    <?php foreach ($courses as $course): ?>
    <div class="col-md-3 mt-4">
  <div class="card" style="width: 15rem;">
    <img class="card-img-top" src="../img/course_covers/<?php echo $course['img_name'];?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><?php echo $course['course_name']; ?></h5>
      <p class="card-text"><?php echo $course['description']; ?></p>
      <p><ul>
            <li>course type:<?php echo $course['course_type'];  ?>   </li>
            <li>class type:<?php echo $course['class_type'];  ?>   </li>
        </ul></p>
      <p class="card-text"><small class="text-muted"><?php echo $course['date'];?></small></p>
    </div>
  </div>
    </div>
    <?php endforeach; ?>
</div>
</div>



<?php include('./teacher_footer.php') ?>

