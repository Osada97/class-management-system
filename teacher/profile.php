<?php require_once '../inc/connection.php';?>
<?php include_once 'teacher_header.php';?>

<div class="container text-center">
    <div class="jumbotron">
        <h1 class="display-4">Username</h1>
        <img src="../img/javascript.png" alt="Profile pic" class="rounded-circle" style="width: 200px; height: 200px">
        <p class="lead">profile id:-</p>
        <p class="lead">Skills</p>
        <span class="badge badge-pill badge-primary">Java</span>
        <span class="badge badge-pill badge-secondary">Python</span>
        <span class="badge badge-pill badge-success">Web Developing</span>
        <span class="badge badge-pill badge-danger">Css</span>
        <span class="badge badge-pill badge-warning">Javascript</span>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <div class="row justify-content-center" >
            <div class="card border-info mb-3" style="max-width: 18rem; margin-right: 20px" >
                <div class="card-header">Courses I have</div>
                <div class="card-body text-info">
                    <h1 class="card-title">5</h1>

                </div>
            </div>
            <div class="card border-info mb-3" style="max-width: 18rem; margin-right: 20px">
                <div class="card-header">Students Enrolled</div>
                <div class="card-body text-info">
                    <h1 class="card-title">100</h1>

                </div>
            </div>
            <div class="card border-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Number of Subjects</div>
                <div class="card-body text-info">
                    <h1 class="card-title">3</h1>

                </div>
            </div>
        </div>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#exampleModal">Edit Profile</a>
        </p>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Profile Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">User name</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Change Profile Picture</label>
                        <input type="file" class="form-control" id="profile-pic">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Profile Bio</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Update Profile</button>
            </div>
        </div>
    </div>
</div>















<?php include_once 'teacher_footer.php';?>
