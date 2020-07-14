<?php include ("../inc/header.php"); ?>
<?php include ("../inc/admin_header.php");?>
<?php include "../inc/adnav.php"; ?>

    <div class="container">
        <h3 class="text-center mt-4 mb-40">Add Teacher</h3>
        <form class="needs-validation" novalidate action="index.php" method="POST">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom01">First name</label>
                    <input type="text" name="firstname" class="form-control" id="validationCustom01"  required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Last name</label>
                    <input type="text" name="lastname" class="form-control" id="validationCustom02"  required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom02">Email</label>
                    <input type="email" name="email" class="form-control" id="validationCustom02"  required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustom03">Phone No</label>
                    <input type="text" class="form-control" id="validationCustom03"  required>
                    <div class="invalid-feedback">
                        Please provide a valid Phone No
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="validationCustom03">Password</label>
                    <input type="password" name="password" class="form-control"  id="validationCustom03" required>
                    <div class="invalid-feedback">
                        Password filed is required!
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationCustom03">confirm password</label>
                    <input type="password" name="cpassword" class="form-control" id="validationCustom03" required>
                    <div class="invalid-feedback">
                        Please Check Your Password
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Add Teacher</button>
        </form>
    </div>

<?php include ("../inc/admin_footer.php"); ?>