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

</style>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Admin Area</div>
      <div class="list-group list-group-flush">
        <a href="../admin/admin_dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="../admin/admin_student.php" class="list-group-item list-group-item-action bg-light">Manage Students</a>
        <a href="../admin/admin_teacher.php" class="list-group-item list-group-item-action bg-light">Manage Teachers</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="admin_dashboard.php"><?php echo $dis['admin_name'] ?></a>
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
