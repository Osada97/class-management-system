<?php include('../inc/admin_header.php') ?>
<?php require_once ('../inc/connection.php');

$query = 'select * from student';
$result = mysqli_query($connection,$query);
$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
//var_dump($data);

?>
      <div class="container-fluid">
        <h1 class="mt-4">Student Management</h1>
       
      </div>

        <div class="row">
            <div class="container">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Add Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Edit Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Remove Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#" >Student List</a>
                        </li>
                    </ul>
                </div>

    <!--Student Table-->

                <table class="table table-hover mt-4">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col">Options</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $details): ?>
                        <tr>
                            <td scope="row"><?php echo $details['st_id'];?></td>
                            <td><?php echo $details['first_name'];?></td>
                            <td><?php echo $details['last_name'];?></td>
                            <td><?php echo $details['user_name'];?></td>
                            <td><?php echo $details['email'];?></td>
                            <td><button class="btn btn-danger">Remove</button></td>
                            <td><button class="btn btn-warning">Freeze</button></td>
                            <td><button class="btn btn-info">More</button></td>

                        </tr>
                    <?php endforeach;?>


                    </tbody>
                </table>



                <!--end Table-->
                <div class="col-md-2"></div>
            </div>
        </div>

  <?php include('../inc/admin_footer.php')?>

