<?php include('../inc/header.php')?>
<?php require_once('../inc/connection.php') ?>

<style>
#wrapper {
    overflow-x: hidden;
 }

#sidebar-wrapper {
  min-height: 100vh;
  margin-left: -15rem;
  -webkit-transition: margin .25s ease-out;
  -moz-transition: margin .25s ease-out;
  -o-transition: margin .25s ease-out;
  transition: margin .25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
}

#sidebar-wrapper .list-group {
  width: 15rem;
}

#page-content-wrapper {
  min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }

  #page-content-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
}

.btn-primary{
  background-color: #ed2a26;
  border-color: #ed2a26;
}
.btn-primary:hover{
  background-color: #ed2a26;
  border-color: #ed2a26;
}
.btn-primary:focus{
  background-color: #ed2a26;
  border-color: #ed2a26;
  box-shadow: 0 0 0 0.2rem #ff262680;
}
.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle{
  background-color: #ed2a26;
  border-color: #ed2a26;
}
#sidebar-wrapper .sidebar-heading{
  font-size: 1.4rem;
  font-weight: 600;
  letter-spacing: 1.5px;
}
a i{
  margin-right: 10px;
}
a.bg-light:focus, a.bg-light:hover, button.bg-light:focus, button.bg-light:hover{
  background-color: #fc7b7929 !important;
}
.list-group-item-action:focus, .list-group-item-action:hover{
  color: #ed2a26;
}
#sidebar-wrapper .sidebar-heading{
  font-size: 1.4rem;
  font-weight: 600;
  letter-spacing: 1.5px;
}
.bg-light{
  background-color: #f8f9fa87!important;
}
.rounded-circle{
  border: 2px solid #ff383866;
}
.border-info {
  border-color: #c2a9a991 !important;
}
.card-title{
  color: red;
} 

</style>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Student's Area</div>
      <div class="list-group list-group-flush">
        <a href="./index.php" class="list-group-item list-group-item-action bg-light"><i class="far fa-sticky-note"></i>Enrolled Courses</a>
        <a href="./dashboard.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a>
        <a href="./profile.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-user-circle"></i>Profile</a>

      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><i class="fas fa-bars"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
              <li class="nav-item">
                <?php  
                  $student_id = $_SESSION['student_id'];
                  $query = "SELECT user_name FROM student WHERE st_id = '{$student_id}' LIMIT 1";
                  $result = mysqli_query($connection,$query);

                  $pic_name = mysqli_fetch_assoc($result);
                ?>
                  <a href="" class="nav-link mr-3"><?php echo $pic_name['user_name']; ?></a>
              </li>
            <li class="nav-item">

              <?php  

                if(!isset($_SESSION['student_id'])){
                  echo '<img src="../img/defaultstudent.png" alt="DP" class="rounded-circle" style="width: 50px; height: 50px">';
                }
                else{

                  //gettting picture
                  $student_id = $_SESSION['student_id'];
                  $query = "SELECT is_image,img_name FROM student WHERE st_id = '{$student_id}' LIMIT 1";
                  $result = mysqli_query($connection,$query);

                  if($result){
                    $pic_res = mysqli_fetch_assoc($result);

                    if($pic_res['is_image'] != 0){
                      if($pic_res['img_name'] != null){
                        $dp = $pic_res['img_name'];
                        echo "<img src='../img/teacher_pic/{$dp}' alt='DP' class='rounded-circle' style='width: 50px; height: 50px'>";
                      }
                      else{
                        echo '<img src="../img/defaultstudent.png" alt="DP" class="rounded-circle" style="width: 50px; height: 50px">';
                      }
                    }
                    else{
                      echo '<img src="../img/defaultstudent.png" alt="DP" class="rounded-circle" style="width: 50px; height: 50px">';
                    }
                  }
                  else{
                    print_r(mysqli_error($connection));
                  }
                }

              ?>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php">Logout</a>
            </li>

          </ul>
        </div>
      </nav>
