<?php include_once('../inc/admin_header.php') ?>
      <div class="container-fluid">
        <h1 class="mt-4">Teacher Management</h1>
        
      </div>

<?php include_once "../inc/adnav.php"; ?>
<?php require_once ('../inc/connection.php');

$query = 'select * from teacher';
$result = mysqli_query($connection,$query);
$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
//var_dump($data);

?>
<!-- start Table -->
<table class="table table-hover mt-4">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Skills</th>
        <th scope="col">Email</th>
        <th scope="col"></th>
        <th scope="col">Options</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $details): ?>
        <tr>
            <td scope="row"><?php echo $details['teacher_id'];?></td>
            <td><?php echo $details['first_name'];?></td>
            <td><?php echo $details['last_name'];?></td>
            <td><?php echo $details['skills'];?></td>
            <td><?php echo $details['email'];?></td>
            <td><button class="btn btn-danger">Remove</button></td>
            <td><button class="btn btn-warning">Freeze</button></td>
            <td><button class="btn btn-info">More</button></td>

        </tr>
    <?php endforeach;?>


    </tbody>
</table>



<!--end Table-->



      
<?php include_once('../inc/admin_footer.php')?>



