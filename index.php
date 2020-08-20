<?php include_once ("inc/header.php")?>
<style>
    .btn:hover{
        background-color: #ef3737bf;
        border-color: #ef3737bf;
    }
    .btn:focus{
        background-color: #ef3737bf;
        border-color: #ef3737bf;
        box-shadow: none;
        color: #fff;
    }
    .btn-outline-primary{
        color: #ef3737bf;
        border-color: #ef3737bf;
    }
    .btn-outline-primary:not(:disabled):not(.disabled):active{
        color: #fff;
        border-color: #ef3737bf;
        background-color: #ef3737bf;
        box-shadow: none;
    }
    .white:hover{
        background-color: #fff;
        border-color: #fff;
    }
    i{
        color: red;
    }

</style>
<?php include_once ("inc/nav.php") ?>
    <main class="page landing-page">
        <section class="clean-block clean-hero" style="background-image:url(&quot;assets/img/tech/image4.jpg&quot;);color:#95131a75;">
            <div class="text">
                <h2>Tution Class Management System</h2>
                <p>Upgrade your Learning Experience in 21 <sup>st</sup> Century</p>
                <a href="signin.php"><button class="btn btn-outline-light btn-lg white" type="button">Learn More</button></a></div>
        </section>
        <section class="clean-block clean-info dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="color: red !important">For Educators</h2>
                    <p>Upload your course materials and Distribute them among students easily.</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6"><img class="img-thumbnail" src="img/students.jpg"></div>
                    <div class="col-md-6">
                        <h3>For Students</h3>
                        <div class="getting-started-info">
                            <p>Choose an Educator, Join with a class Download course materials, Stream videos in anytime anywhere</p>
                        <a href="signup.php"><button class="btn btn-outline-primary btn-lg" type="button">Join Now</button></a></div>
                </div>
            </div>
        </section>
        <section class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="color: red !important">Features</h2>
                    <p>Experience well enhanced and improved education with Lanka Elearning</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-5 feature-box"><i class="icon-people icon"  style="color: red"></i>
                        <h4>Big Community</h4>
                        <p>Join with 1000s of other students and more than 100 Educators.</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-pencil icon"  style="color: red"></i>
                        <h4>On Demand</h4>
                        <p>More than 1000 on demand courses. Enroll with what you want watch them when you need</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-like icon"  style="color: red"></i>
                        <h4>Free</h4>
                        <p>Dont pay even a cent get all these services for free .</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-refresh icon"  style="color: red"></i>
                        <h4>All Browser Compatibility</h4>
                        <p>Flexible rendering for every browser in the world. Use any browse you want we serve you anywhere anytime</p>
                    </div>
                </div>
            </div>
        </section>
<!--        <section class="clean-block slider dark">-->
<!--            <div class="container">-->
<!--                <div class="block-heading">-->
<!--                    <h2 class="text-info">Slider</h2>-->
<!--                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>-->
<!--                </div>-->
<!--                <div class="carousel slide" data-ride="carousel" id="carousel-1">-->
<!--                    <div class="carousel-inner" role="listbox">-->
<!--                        <div class="carousel-item active"><img class="w-100 d-block" src="assets/img/scenery/image1.jpg" alt="Slide Image"></div>-->
<!--                        <div class="carousel-item"><img class="w-100 d-block" src="assets/img/scenery/image4.jpg" alt="Slide Image"></div>-->
<!--                        <div class="carousel-item"><img class="w-100 d-block" src="assets/img/scenery/image6.jpg" alt="Slide Image"></div>-->
<!--                    </div>-->
<!--                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button"-->
<!--                            data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>-->
<!--                    <ol class="carousel-indicators">-->
<!--                        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>-->
<!--                        <li data-target="#carousel-1" data-slide-to="1"></li>-->
<!--                        <li data-target="#carousel-1" data-slide-to="2"></li>-->
<!--                    </ol>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
        <section class="clean-block about-us">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="color: red !important">About Us</h2>
                    <p>We are a digital marketing company that focuses on new trends and web solutions worldwide</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="assets/img/avatars/avatar1.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">John Smith</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <div class="icons"><a href="#"><i class="icon-social-facebook"></i></a><a href="#"><i class="icon-social-instagram"></i></a><a href="#"><i class="icon-social-twitter"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="assets/img/avatars/avatar2.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">Robert Downturn</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <div class="icons"><a href="#"><i class="icon-social-facebook"></i></a><a href="#"><i class="icon-social-instagram"></i></a><a href="#"><i class="icon-social-twitter"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card clean-card text-center"><img class="card-img-top w-100 d-block" src="assets/img/avatars/avatar3.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">Ally Sanders</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <div class="icons"><a href="#"><i class="icon-social-facebook"></i></a><a href="#"><i class="icon-social-instagram"></i></a><a href="#"><i class="icon-social-twitter"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
   <?php include_once ("inc/footer.php")?>