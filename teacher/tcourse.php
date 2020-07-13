<?php include_once '../inc/header.php'; ?>
<?php include_once 'teacher_header.php'; ?>
<?php include_once 'tnav.php'; ?>

<div class="container">
    <h3 class="text-center mt-4 mb-4">Add Course</h3>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Course Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Teacher Id</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword3">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Enroll Key</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword3">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Course Image</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="inputPassword3">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
            <textarea type="text" class="form-control" id="inputPassword3"></textarea>
        </div>
    </div>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Course Type</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                    <label class="form-check-label" for="gridRadios1">
                        A/L
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                        O/L
                    </label>
                </div>

            </div>
        </div>
    </fieldset>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Class Type</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="gridRadios" id="gridRadios1" value="option1" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Theory
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="gridRadios" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                        Revision
                    </label>
                </div>

            </div>
        </div>
    </fieldset>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Add Course</button>
        </div>
    </div>
</form>
</div>


<?php include_once 'teacher_footer.php'; ?>
