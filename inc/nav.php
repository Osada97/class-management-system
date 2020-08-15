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
    .navbar-light .navbar-nav .nav-link.active{
        color: red;
    }
    .navbar-light .navbar-nav .nav-link:hover{
        color: #ff000094;
    }
</style>
<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
    <div class="container"><a class="navbar-brand logo" href="#"><img src="./img/logo.png" alt=""></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
             id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="signin.php">Sign In</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="signup.php">Sign Up</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="about-us.php">About Us</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>