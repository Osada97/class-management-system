<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once ('../inc/connection.php');?>
<?php include_once ('stu_header.php'); ?>

<?php  
    
    if(!isset($_SESSION['student_id'])){
        header('Location:../signin.php');
    }
    else{

        require_once('../inc/coursetimeago.php');

        $display_courses ="";
        $student_id = $_SESSION["student_id"];

        $query = "SELECT * FROM course_enroll WHERE student_id = '{$student_id}' ORDER BY enroll_no DESC";
        $result = mysqli_query($connection,$query);

        if($result){
            if(mysqli_num_rows($result) >0){
                while($contcos = mysqli_fetch_assoc($result)){

                    $course_id = $contcos['course_id'];

                    $course_query = "SELECT * FROM course WHERE course_id ={$course_id}";
                    $course_result = mysqli_query($connection,$course_query);

                    if($course_query){
                        $course_de = mysqli_fetch_assoc($course_result);

                        $display_courses.= '<div class="card">';
                        $display_courses .='<div class="option">';
                            $display_courses.='<div class="but">';
                                $display_courses.='<button><i class="fas fa-ellipsis-v"></i></button>';
                            $display_courses.='</div>';
                                $display_courses.='<div class="drop_down">';
                                    $display_courses.='<a href="viewcourse.php?course_id='.$course_id.'">Open</a>';
                                    $display_courses.='<a href="unenrollcporse.php?course_id='.$course_id.'" onclick="return confirm(\'Are You Sure?\')">Unenroll</a>';
                                $display_courses.='</div>';
                        $display_courses .='</div>';
                        $display_courses .='<a href="viewcourse.php?course_id='.$course_id.'">';
                            //img set
                            $display_courses .= '<div class="cous_img">';
                            if($course_de['course_img']!=0){
                                if($course_de['img_name']!=null){
                                    $img_name = $course_de['img_name'];
                                    $display_courses .= '<img src="../img/course_covers/'.$img_name.'" class="card-img-top" alt="...">';
                                }
                                else{
                                    $display_courses .= '<img src="../img/csd.jpg" class="card-img-top" alt="...">';
                                }
                            }
                            else{
                                $display_courses .= '<img src="../img/csd.jpg" class="card-img-top" alt="...">';
                            }
                            $display_courses .= '</div>';

                            $display_courses.= '<div class="card-body">';
                                $display_courses.= '<h5 class="card-title">' . $course_de['course_name'] .'</h5>';
                                //displya teacher name
                                $query_tc = "SELECT CONCAT(first_name,' ',last_name) AS name FROM teacher WHERE teacher_id = {$course_de['teacher_id']} LIMIT 1";
                                $result_tc = mysqli_query($connection,$query_tc);
                                $nma = mysqli_fetch_assoc($result_tc);

                                $display_courses .= '<h6><i class="fas fa-user-tie"></i>'. $nma['name'] .'</h6>';

                                $display_courses .= '<div class="tiny_dis">';
                                    $display_courses .= "<div class='course_type'>";
                                        $display_courses .= "<h6><i class='fas fa-graduation-cap'></i>" . $course_de['course_type'] . "</h6>";
                                    $display_courses .= "</div>";
                                    $display_courses .= "<div class='class_type'>";
                                        $display_courses .= "<h6><i class='fas fa-school'></i>" . $course_de['class_type'] . "</h6>";
                                    $display_courses .= "</div>";
                                $display_courses .= '</div>';

                                if(strlen($course_de['description'])>80){
                                    $display_courses.= '<p class="card-text">' . substr($course_de['description'],0,80) .'...</p>';
                                }
                                else{
                                    $display_courses.= '<p class="card-text">'.$course_de['description'].'</p>';
                                }

                            $display_courses.= '</div>';
                        $display_courses.="</a>";
                                $display_courses.= '<div class="time">';
                                    $display_courses.= '<p><i class="far fa-clock"></i>'.course_time_ago($course_de["date"]).'</p>';
                                $display_courses.= '</div>';
                        $display_courses.= '</div>';
                    }
                }

            }
            else{
                header('refresh:3;url=dashboard.php');
            }
        }
        else{
            print_r(mysqli_error($connection));
        }
    }


?>

<style>
    a{
        text-decoration: none;
        color: #000;
    }
    a:hover{
        text-decoration: none;
        color: #000;
    }
    .container{
        margin-top: 25px;
    }
    .card{
        position: relative;
        min-width: 350px;
        max-width: 350px;
        margin-top: 15px;
        transition: 0.5s;
        border: 1px solid #ec5b5b6e;
    }
    .card:hover{
        box-shadow: 0px 0px 12px 9px #eeeeee7d;
    }
    .card .option{
        position: absolute;
        top: 10px;
        right: 15px;
        text-align: right;
    }
    .card .option button{
        outline: none;
        border: none;
        background: none;
        border: none;
    }
    .card .option .drop_down{
        position: absolute;
        right: 0;
        opacity: 0;
        pointer-events: none;
        background-color: #fff;
        border-radius: 3px;
        box-shadow: 0px 0px 12px 8px #8d8d8d59;
        transition: 0.3s;
        overflow: hidden;
    }
    .card .option:hover .drop_down{
        opacity: 1;
        pointer-events: all;
    }
    .card .option .drop_down a{
        display: block;
        width: 100px;
        padding: 8px;
        font-size: 13px;
        transition: 0.3s ease-in;
    }
    .card .option .drop_down a:last-child{
        color: red;
    }
    .card .option .drop_down a:hover{
        background-color: #f7f7f7;
        transform: translateX(-2px);
    }

    /*card styling*/
    .card .cous_img{
        width: 100%;
        height: 180px;
    }
    .card .cous_img img{
        width: 100%;
        height: 100%;
    }
    .card .card-body{
        height: 250px;
    }
    .card .card-body i{
        margin-right: 5px;
    }
    .card .card-body .tiny_dis{
        width: 100%;
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
        text-transform: uppercase;
        color: #868080;
    }
    .card .card-body .tiny_dis i{
        color: #ff6868;
    }
    .card .card-body .tiny_dis h6{
        font-size: 13px;
    }
    .card .card-body p{
        font-size: 13px;
    }
    .card .time{
        width: 100%;
        padding: 3px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        font-size: 12px;
    }
    .card .time i{
        margin-right: 3px;
    }
</style>

<div class="container">
    <div class="card-deck">
        <?php echo $display_courses; ?>
        <!-- <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        
        
            </div>-->
    </div>
</div>

<script src="https://kit.fontawesome.com/4f6c585cf2.js" crossorigin="anonymous"></script>
<?php include_once ('stu_footer.php'); ?>