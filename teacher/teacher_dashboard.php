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
                $setcos .= "<div class='card'>";

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

                $setcos .= "<a href='#'>";
                $setcos .= "<div class='card-body'>";
                $setcos .= "<h5 class='card-title'>" . $result_cos['course_name'] ."</h5>";
                $setcos .= "<h6 class='card-title'>" . $result_cos['course_type'] ."</h6>";
                $setcos .= "<h6 class='card-title'>" . $result_cos['class_type'] ."</h6>";

                if(strlen($result_cos['description'])>80){

                    $setcos .= "<p class='card-text'>" .substr($result_cos['description'], 0,80) . "..</p>";
                }
                else{
                    $setcos .= "<p class='card-text'>" . $result_cos['description'] . "</p>";
                }

                $setcos .= "</div>";
                $setcos .= "</a>";
                $setcos .= "<div class='card-footer'>";
                $setcos .= "<small class='text-muted'>" . course_time_ago($result_cos['date']) . "</small>";
                $setcos .= " </div>";

                $setcos .= "</div>";
            }
        }
    }
    else{
        print_r(mysqli_error($connection));
    }

?>

<?php include('./teacher_header.php') ?>
<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
</div>
<?php include_once 'tnav.php';?>

<div class="container mt-4">
    <div class="card-deck">

        <?php echo $setcos; ?>

    </div>
</div>



<?php include('./teacher_footer.php') ?>



























