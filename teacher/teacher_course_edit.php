<?php include_once '../inc/header.php'; ?>
<?php include_once 'teacher_header.php'; ?>
<?php include_once 'tnav.php'; ?>
<?php require_once ('../inc/connection.php'); ?>

<div class="container">
<form action="tcourse.php" method="POST" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Course Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" name="course_name"
                   value="<?php echo($course_name) ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Enroll Key</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputPassword3" name="enroll_key"
                   value="<?php echo($enroll_key) ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Course Image</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="inputPassword3" name="course_image">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
                <textarea type="text" class="form-control" id="inputPassword3"
                          name="description"><?php echo $description; ?></textarea>
        </div>
    </div>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Course Type</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="gridRadios1" value="a/l" name="course_type"
                           checked>
                    <label class="form-check-label" for="gridRadios1">
                        A/L
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="gridRadios2" value="o/l" name="course_type">
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
                    <input class="form-check-input" type="checkbox" id="gridRadios1" value="theory"
                           name="class_type[]" checked>
                    <label class="form-check-label" for="gridRadios1">
                        Theory
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridRadios2" value="revision"
                           name="class_type[]">
                    <label class="form-check-label" for="gridRadios2">
                        Revision
                    </label>
                </div>

            </div>
        </div>
    </fieldset>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" name="add" class="btn btn-primary">Update Course</button>
        </div>
    </div>
</form>
</div>

<?php include_once ("teacher_footer.php");