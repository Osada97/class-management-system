<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once('../inc/connection.php') ?>

<?php

  if(!isset($_SESSION['admin_id'])){
    header('Location:../signin.php');
  }  

  $admin_id = $_SESSION['admin_id'];

  $query_dp ="SELECT * FROM admin WHERE admin_id={$admin_id} LIMIT 1";
  $result_dp =mysqli_query($connection,$query_dp);

  $dis = mysqli_fetch_assoc($result_dp);

?>

<?php include('../inc/header.php')?>
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



</style>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Admin Area</div>
      <div class="list-group list-group-flush">
        <a href="../admin/admin_dashboard.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a>
        <a href="../admin/admin_student.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-user-graduate"></i>Manage Students</a>
        <a href="../admin/admin_teacher.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-user-tie"></i>Manage Teachers</a>
        <a href="../admin/profile.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-user-circle"></i>Profile</a>
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
            <li class="nav-item active">
              <a class="nav-link" href="admin_dashboard.php" style="color: #ed2a26;font-size: 17px;letter-spacing: 1.5px"><?php echo $dis['admin_name'] ?></a>
            </li>
            <li class="nav-item">

                <?php  

                  if($dis['is_image']!=0){
                    if($dis['img_name']!=null){
                      echo '<img src="../img/'.$dis['img_name'].'" alt="" class="rounded-circle" style="width: 50px; height: 50px">';
                    }
                    else{
                      echo '<img src="../img/admin.png" alt="" class="rounded-circle" style="width: 50px; height: 50px">';
                    }
                  }
                  else{
                    echo '<img src="../img/admin.png" alt="" class="rounded-circle" style="width: 50px; height: 50px">';
                  }

                ?>
                
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php">
                Logout
              </a>

            </li>
          </ul>
        </div>
      </nav>
