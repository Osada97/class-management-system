<?php ob_start(); ?>
<?php session_start(); ?>
<?php require_once('../inc/connection.php') ?>
<?php  

    //checking sessions
    if(!isset($_SESSION['teacher_id'])){
        header('Location:../signin.php?err=true');
    }

?>

<?php  
    
    //call course time ago
    require_once('../inc/coursetimeago.php');

    //getting courses
    $teacher_id = $_SESSION['teacher_id'];
    
    $query_get_cs = "SELECT * FROM course WHERE teacher_id = {$teacher_id} ORDER BY course_id DESC";
    $result_get = mysqli_query($connection,$query_get_cs);

    if($result_get){
        if(mysqli_num_rows($result_get)>0){
            $setcos = "";
            while($result_cos = mysqli_fetch_assoc($result_get)){
                $setcos .= "<div class=\"card\" style=\"min-width: 16rem; max-width:22rem; cursor:pointer; margin-bottom:10px; position:relative; \">";

                $setcos .= "<div class='dropdownop'>";
                $setcos .= "<button class='drop-btn'><i class='fas fa-ellipsis-v'></i></button>";
                $setcos .= "<div class='dropdown_content'>";
                $setcos .= "<a href='#'>Open</a>";
                $setcos .= "<a href='teacher_course_edit.php?course_id={$result_cos['course_id']}'>Edit</a>";
                $setcos .= "<a href='teacher_course_delete.php?course_id={$result_cos['course_id']}' onclick=\"return confirm('Are You Sure?🙄')\">Delete</a>";
                $setcos .= "</div>";
                $setcos .= "</div>";

                //checking course have an image
                if($result_cos["course_img"] != 0){
                    //checking course have an image
                    if($result_cos["img_name"] != null){
                         $setcos .= "<img src='../img/course_covers/{$result_cos['img_name']}' class='card-img-top' style= 'height:250px;'> ";
                    }
                    else{
                        $setcos .= "<img src='../img/csd.jpg' class='card-img-top' style= 'height:250px;'> ";
                    }
                }
                else{
                    $setcos .= "<img src='../img/csd.jpg' class='card-img-top' style= 'height:250px;'> ";
                }

                $setcos .= "<a href='#' style='text-decoration:none;color:#000'>";
                $setcos .= "<div class='card-body' style='height:230px'>";
                $setcos .= "<h5 class='card-title' >" . $result_cos['course_name'] ."</h5>";

                if(strlen($result_cos['description'])>80){

                    $setcos .= "<p class='card-text'>" .substr($result_cos['description'], 0,80) . "..</p>";
                }
                else{
                    $setcos .= "<p class='card-text'>" . $result_cos['description'] . "</p>";
                }
                $setcos .= "<p><ul>";
                $setcos .= "<li>Course type: <span style='text-transform:uppercase'> " . $result_cos['course_type'] . "</span></li>";
                $setcos .= "<li>Class type:  <span style='text-transform:uppercase'>" . $result_cos['class_type'] . "</span></li>";
                $setcos .= "</ul></p>";
                $setcos .= "</div>";
                $setcos .= "</a>";
                $setcos .= "<div class='card-footer'>";
                $setcos .= "<small class='text-muted'>" . course_time_ago($result_cos['date']) . "</small>";
                $setcos .= " </div>";

                $setcos .= "</div>";
            }
        }
        else{
            $setcos="";
            header('refresh:3;url=profile.php');
        }
    }
    else{
        print_r(mysqli_error($connection));
    }

?>

<?php include('./teacher_header.php') ?>

<!-- adding styles -->
<style>
    .dropdownop{
        position: absolute;
        top: 5px;
        right: 10px;
    }
    .dropdownop .drop-btn{
        background: none;
        cursor: pointer;
        border:none;
        outline: :none;
    }
     .dropdownop:hover .dropdown_content{
        opacity: 95%;
        pointer-events: all;
        display: block;
    }
    .dropdownop .dropdown_content{
        opacity: 0;
        pointer-events: none;
        position: absolute;
        right: 0;
        width: 120px;
        text-align: center;
        border-radius: 3px;
        background-color: #fff;
        box-shadow: -1px 0px 12px 12px #b4b4b445;
        transition: 0.5s ease; 
    }
    .dropdownop .dropdown_content a{
        display: block;
        padding: 4px;
        margin-bottom: 3px;
        color: #000;
        font-size: 13px;
        text-decoration: none;
        transition: 0.3s;
    }
    .dropdownop .dropdown_content a:last-child{
        color: red;
    }
    .dropdownop .dropdown_content a:hover{
        background-color: #eeeeee94;
    }
</style>

<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
</div>
<?php include_once 'tnav.php';?>

<div class="container mt-4">
    <div class="card-deck">

        <?php echo $setcos; ?>

    </div>
</div>


<script src="https://kit.fontawesome.com/4f6c585cf2.js" crossorigin="anonymous"></script>
<?php include('./teacher_footer.php') ?>



























