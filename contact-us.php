<?php 

    if (isset($_POST["send"])) {
        
        $name = mysqli_real_escape_string($connection,$_POST["name"]);
        $subject = mysqli_real_escape_string($connection,$_POST["subject"]);
        $email = mysqli_real_escape_string($connection,$_POST["email"]);
        $phone_number = mysqli_real_escape_string($connection,$_POST["phone_number"]);
        $msg = mysqli_real_escape_string($connection,$_POST["msg"]);

        $to = "";
        $mail_subject = "Message From Jobberlk";
        $email_body = "Message From Contact Us Page Of Jobberlk.com <br>";
        $email_body .= "<b>From:</b> {$name} <br>";
        $email_body .= "<b>Subject:</b> {$subject} <br>";
        $email_body .= "<b>Phone Number:</b> {$phone_number}<br>";
        $email_body .= "<b>message:</b> <br>" . nl2br(strip_tags($msg));

        $header = "From {$email} \r\nContent-type : text/html;";

        $mail_is = mail($to, $mail_subject,$email_body,$header);

        if($mail_is == true){
            echo "<script>";
                echo "alert('Successfully  Send The Message ')";
            echo "</script>";
        }
        else{
            echo "<script>";
                echo "alert('Please Try Again')";
            echo "</script>";
        }

    }

?>
<?php include_once ("inc/header.php")?>
<?php include_once ("inc/nav.php") ?>
<style>
    .clean-block.clean-form form{
        border-top-color: #ffa2a2;
    }
     form{
        max-width: 550px !important;
    }
    form .form-control:focus{
        box-shadow: none;
        border-color: red;
    }
</style>
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="color: red !important">Contact Us</h2>
                    <p>Feel Free to message us we reply in lightning speed</p>
                </div>
                <form>
                    <div class="form-group"><label>Name</label><input class="form-control" type="text" name="name" required max="100"></div>
                    <div class="form-group"><label>Subject</label><input class="form-control" type="text" name="subject" required max="100"></div>
                    <div class="form-group"><label>Email</label><input class="form-control" type="email" name="email" required max="100"></div>
                    <div class="form-group"><label>Message</label><textarea class="form-control" name="message" required max="255"></textarea></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: #e83e3e;box-shadow: none;border-color: red">Send</button></div>
                </form>
            </div>
        </section>
    </main>

<?php include_once ("inc/footer.php") ?>