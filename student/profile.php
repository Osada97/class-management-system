<?php # require_once ('../inc/connection.php'); ?>
<?php include_once ('stu_header.php'); ?>


<div class="container text-center">
    <div class="jumbotron">
        <h1 class="display-4">Student Name</h1>

        <img src="../img/defaultteacher.png" alt='Profile pic' class='rounded-circle' style='width: 200px; height: 200px'>


        <p class="lead">profile id:-</p>
        <p class="lead">Skills</p>


        <hr class="my-4">
        <p></p>
        <div class="row justify-content-center">
            <div class="card border-info mb-3" style="max-width: 18rem; margin-right: 20px">
                <div class="card-header">Courses I Enrolled</div>
                <div class="card-body text-info">
                    <h1 class="card-title">5</h1>

                </div>
            </div>

            <div class="card border-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Number of Learning</div>
                <div class="card-body text-info">
                    <h1 class="card-title">3</h1>

                </div>
            </div>
        </div>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#exampleModal">Edit
                Profile</a>
        </p>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Profile Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="profile.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="recipient-name" name="first_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="recipient-name" name="last_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="recipient-email" name="email" value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="col-form-label">Phone Number</label>
                        <input type="text" class="form-control" id="recipient-email" name="phone_number" value="">
                    </div>
                    <div class="form-group">
                        <label for="recipient-email" class="col-form-label">Skills</label>
                        <input type="text" class="form-control" id="recipient-skills" placeholder="Add Your Skills">
                        <button type="button" id="add" class="form-control"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Change Profile Picture</label>
                        <input type="file" class="form-control" id="profile-pic" name="teacherpic">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Profile Bio</label>
                        <textarea class="form-control" id="message-text"
                                  name="bio"><?php echo($prode['bio']) ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/4f6c585cf2.js" crossorigin="anonymous"></script>

<?php include "stu_footer.php"; ?>