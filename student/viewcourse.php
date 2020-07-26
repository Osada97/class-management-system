<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once ("../inc/connection.php");?>

<?php  

    if(!isset($_SESSION['student_id'])){
        header('Location:../signin.php');
    }
    if(!isset($_GET['course_id'])){
        header('Location:../signin.php');
    }
    else{
        $course_id = $_GET['course_id'];
        $student_id= $_SESSION['student_id'];
        $display = "";
        $me = "";

        require_once('../inc/coursetimeago.php');

        //getting chapters
        $query_get = "SELECT DISTINCT(chapter) AS chapter FROM media WHERE course_id = {$course_id}";
        $result_get = mysqli_query($connection,$query_get);

        if($result_get){
            if(mysqli_num_rows($result_get) > 0){
                while($geet= mysqli_fetch_assoc($result_get)){

                    $display .= '<div class="row mt-4">';
                    $display .= '<div class="col-md-12">';
                    $display .= '<div class="card">';
                    $display .= '<div class="card-header">';
                    $display .= 'Chapter 0' . $geet['chapter'];
                    $display .= '</div>';
                    $display .= '<div class="card-body" >';

                    $rl_get_query = "SELECT * FROM media WHERE course_id={$course_id} AND chapter={$geet['chapter']}";
                    $result_rl_get = mysqli_query($connection,$rl_get_query);

                    if($result_rl_get){
                        $me = "";
                        $txt ="";
                        $display .= '<blockquote class="blockquote mb-0">';
                        while ($mdget = mysqli_fetch_assoc($result_rl_get)) {

                            if($mdget['is_media']!=0){
                                $me .= '<div class="me_row">';

                                $up = explode('.', $mdget['media']);
                                $up_file_ty = array_pop($up);

                                 //checking file type
                                if($up_file_ty == "html" || $up_file_ty == "css" ){
                                    $me .= '<img src="../img/media_png/htm-css.png">';
                                }
                                if($up_file_ty == "jpg" || $up_file_ty == "jepg" || $up_file_ty == "mpeg" ){
                                    $me .= '<img src="../img/media_png/jpg.png">';
                                }
                                if($up_file_ty == "png" ){
                                    $me .= '<img src="../img/media_png/png.png">';
                                }
                                if($up_file_ty == "gif" ){
                                    $me .= '<img src="../img/media_png/gif.png">';
                                }
                                if($up_file_ty == "txt" ){
                                    $me .= '<img src="../img/media_png/txt.png">';
                                }
                                if($up_file_ty == "pdf" ){
                                    $me .= '<img src="../img/media_png/pdf.png">';
                                }
                                if($up_file_ty == "xls" ){
                                    $me .= '<img src="../img/media_png/xls.png">';
                                }
                                if($up_file_ty == "mp3" ){
                                    $me .= '<img src="../img/media_png/mp3.png">';
                                }
                                if($up_file_ty == "docx" ){
                                    $me .= '<img src="../img/media_png/docx.png">';
                                }
                                if($up_file_ty == "js" ){
                                    $me .= '<img src="../img/media_png/javascript.png">';
                                }
                                if($up_file_ty == "pptx" || $up_file_ty == "ppt"){
                                    $me .= '<img src="../img/media_png/ppt.png">';
                                }
                                if($up_file_ty == "mp4"){
                                    $me .= '<img src="../img/media_png/mp4.png">';
                                }


                                $name = explode('-', $mdget['media']);
                                unset($name[0]);
                                unset($name[1]);

                                $media_name = implode('-', $name);

                                $me .= '<div class="pr">';
                                $me .= '<a href="../course_media/'.$mdget['media'].'" target="_block">'.$media_name.'</a>';
                                $me .= '</div>';
                                $me .= '<div class="dl">';
                                $me .= '<a href="../course_media/'.$mdget['media'].'" download><button class"dl_but"><i class="fas fa-cloud-download-alt"></i></button></a>';
                                $me .= '</div>';
                                $me .= '</div>';
                            }
                                $txt= $mdget['text'];
                                $time = $mdget['date'];
                        }

                            if($txt!=null){
                                $display .= '<p>'.$txt.'</p>';
                            }
                    $display .= $me;
                    $display .= '<footer class="blockquote-footer"><i class="far fa-clock"></i>'.course_time_ago($time).'</footer>';
                    $display .= '</blockquote>';
                    $display .= '</div>';
                    $display .= '</div>';
                    $display .= '</div>';
                    $display .= '</div>';

                    }
                }
            }
            else{
                $display .="<div class ='no'>";
                $display .="<div class ='te'>";
                $display .="<h2>Don't Have Any Course Materials</h2>";
                $display .="</div>";
                $display .="<div class ='nosvg'>";
                $display .="<img src='../img/no.svg'>";
                $display .="</div>";
                $display .="</div>";
            }
        }
    }


    $course_query = "SELECT * FROM course WHERE course_id= {$course_id} LIMIT 1";
    $result_course = mysqli_query($connection,$course_query);

    $cos = mysqli_fetch_assoc($result_course);

?>




<?php include_once ("../inc/header.php");?>


<!-- styling goes in here -->
<style>
    .bg-dark{
        height: 300px;
    }
    .bg-dark img{
        height: 100%;
    }
    .card .card-body .me_row{
        width: 100%;
        padding: 5px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        border-bottom: 1px solid #eee;
        transition: 0.3s;
    }
    .card .card-body .me_row:hover{
        background-color: #ffbdbd2e;
    }
    .card .card-body .me_row:hover .pr a{
        color: red;
    }
    .card .card-body .me_row:hover .dl button{
        color: #000;
    }
    .card .card-body .me_row .pr{
        flex: 3;
    }
    .card .card-body .me_row .dl{
        text-align: right;
        flex: 1;
    }
    .card .card-body .me_row img{
        height: 25px;
        width: 25px;
        margin-right: 10px;
    }
    .card .card-body .me_row .pr a{
        color: #1121d3;
        font-size: 15px;
        text-decoration: none;
    }
    .card .card-body .me_row .dl button{
        border: none;
        background: none;
        outline: none;
        color: #1121d3;
        transition: 0.5s;
    }
     .card .card-body .me_row .dl button:hover{
        color: #dc3545;
     }
     .card .card-header{
        font-weight: 600;
        color: #fff;
        background-image: linear-gradient(90deg,#cd6161c7,#00035794);
     }
     .card .card-body p{
        font-size: 16px;
     }
     .card footer{
        width: 100%;
        text-align: right;
     }
     .card footer i{
        margin-right: 5px; 
     }
     .no{
        width: 100%;
        margin-top: 25px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
     }
     .no .nosvg{
        width: 200px;
     }
     .no .nosvg img{
        width: 100%;
     }
</style>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
    <div class="card bg-dark text-white">
        <img src="../img/course.svg" class="card-img" alt="...">
        <div class="card-img-overlay">
            <h5 class="card-title "><?php echo $cos['course_name'] ?></h5>
            <?php
                 if($cos['description']!=null){
                    echo "<p class='card-text'>". substr($cos['description'], 0,100) ."</p>";
                 } 
            ?>
            <h5 style="text-transform: uppercase;"><?php echo $cos['course_type'] ?></h5>
            <p class="card-text" style="margin-top: 100px"><a href="./index.php"><button class="btn btn-info"><i class="fas fa-arrow-circle-left"></i></button></a></p>
        </div>
    </div>
            <!-- <div class="row mt-4">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Module 01
                    </div>
                    <div class="card-body" >
                        <blockquote class="blockquote mb-0">
                            <p>Welcome to the module one </p>
                            <footer class="blockquote-footer">Author<cite title="Source Title"> Chaminda Rajapaksha</cite></footer>
                        </blockquote>
                    </div>
                </div>
                </div>
            </div> -->

            <?php echo $display; ?>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>

<script src="https://kit.fontawesome.com/4f6c585cf2.js" crossorigin="anonymous"></script>