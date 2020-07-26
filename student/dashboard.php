<?php ob_start(); ?>
<?php require_once ('../inc/connection.php'); ?>
<?php session_start(); ?>

<?php  

    if(!isset($_SESSION['student_id'])){
        header("Location:../signin.php");
    }

    if(isset($_POST['ennroll'])){

        $student_id = $_SESSION['student_id'];
        $teacher_id=$_POST['teacher_id'];
        $course_id = $_POST['course_id'];

        if($_POST['is_enrolled']==1){

            if(!empty(trim($_POST['enroll_key']))){
                $enroll_key = $_POST['enroll_key'];

                $query = "SELECT enroll_key FROM course WHERE course_id = {$course_id} LIMIT 1";
                $result = mysqli_query($connection,$query);

                if ($result) {
                    $cos = mysqli_fetch_assoc($result);

                    if($enroll_key == $cos['enroll_key']){
                       $in_query = "INSERT INTO course_enroll(course_id,teacher_id,student_id) VALUES({$course_id},{$teacher_id},'{$student_id}')";
                       $result_in = mysqli_query($connection,$in_query);

                       if($result_in){
                            header('Location:index.php');
                       }

                    }
                    else{
                        $error[] = "Enroll Key Is Invalid";
                    }
                }
            }
            else{
                $error[] = "Please Enter Enroll Key";
            }
        }
        else{
            $in_query = "INSERT INTO course_enroll(course_id,teacher_id,student_id) VALUES({$course_id},{$teacher_id},'{$student_id}')";
            $result_in = mysqli_query($connection,$in_query);
        }

    }
    
?>
<?php  

    //pagination
    $pagi_query ="SELECT count(course_id) AS courses FROM course";
    $result_pagi = mysqli_query($connection,$pagi_query);

    if($result_pagi){
        $cu = mysqli_fetch_assoc($result_pagi);
    }

    $grid_per_page = 12;

    if(isset($_GET['p'])){
        $page_number = $_GET['p'];
    }
    else{
        $page_number =1;
    }

    $start = ($page_number-1)*$grid_per_page;

    //set links
    $first = "<a href='dashboard.php?p=1' class='page-link' aria-label='First'> <span aria-hidden='true'>First</span></a>";

    $last = ceil($cu['courses']/$grid_per_page);
    $last_nu ="<a href='dashboard.php?p={$last}' class='page-link' aria-label='Last'> <span aria-hidden='true'>Last</span></a>";

    if($page_number==1){
        $first = "<a class='page-link' aria-label='First'> <span aria-hidden='true'>First</span></a>";
        $previous = "<a class='page-link' aria-label='Previous'><span aria-hidden='true'>Previous</span></a>";
    }
    else{
        $pre = $page_number -1;
        $previous = "<a href='dashboard.php?p={$pre}' class='page-link' aria-label='Previous'><span aria-hidden='true'>Previous</span></a>";
    }

    if($page_number==$last){
        $last_nu = "<a class='page-link' aria-label='Last'> <span aria-hidden='true'>Last</span></a>";
        $next = "<a class='page-link' aria-label='Next'> <span aria-hidden='true'>Next</span></a>";
    }
    else{
        $nex = $page_number+1;
        $next = "<a href='dashboard.php?p={$nex}' class='page-link' aria-label='Next'> <span aria-hidden='true'>Next</span></a>";
    }

?>

<?php include_once ('stu_header.php'); ?>

<!-- style goes in here -->
<style>
    /*error styling*/
    .container{
        position: relative;
    }
    .err_model{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #00000024;
        transition: 0.5s;
    }
    .errors{
        width: 400px;
        padding: 8px;
        background-color: #fff;
        border: 1px solid #ff9e9e4a;
        z-index: 100;
        text-align: center;
        box-shadow: 0px 0px 12px 0px #ff9e9e4a;
    }
    .errors .close{
        width: 100%;
        text-align: right;
    }
    .errors .close button{
        outline: none;
        border: none;
        background: none;
        font-size: 14px;
    }
    .erhide{
        opacity: 0;
    }
    @media screen and (max-width: 500px) {
        .errors{
            width: 90%;
        }
    }
    /*styling show all courses*/
    .mb-4{
        min-width: 33%;
    }
    .card{
        min-width: 100%;
        transition: 0.5s;
    }
    .card:hover{
        box-shadow: 0px 0px 15px 15px #eeeeee4d;
    }
    .card .course_img{
        width: 100%;
        height: 180px;
        overflow: hidden;
    }
    .card .course_img img{
        width: 100%;
        height: 100%;
    }
    .card .tiny_dis{
        width: 100%;
        padding: 8px;
        display: flex;
        justify-content: space-between;
    }
    .card .tiny_dis i{
        margin-right: 5px;
        color: #ff6868;
    }
    .card .tiny_dis h6{
        text-transform: uppercase;
        font-size: 14px;
        color: #868080;
    }
    .card .bod{
        height: 80px;
        font-size: 13px;
    }
    .card h6 i{
        margin-right: 5px;
    }
    .card form{
        width: 100%;
        text-align: center;
    }
    .card form input{
        width: 80%;
        outline-color: #b03b3b;
        border:1px solid #b03b3b;
        border-radius: 3px;
        box-shadow: 0px 0px 15px 5px #e49c9c1c; 
        padding: 3px;
    }
    .row .container{
        display: flex;
        justify-content: center;
    }
    .form-inline{
        width: 100%;
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


<div class="row mt-4">
    <div class="container">
    <div class="col-md-8">
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Courses" aria-label="Search" id="search_cos" style="width: 100%">
        </form>
    </div>
    <div class="col-md-2"></div>
    </div>

</div>



<div class="container mt-4">
    <?php  
        //errors box
        if(!empty($error)){
            echo '<div class="err_model">';
                echo ' <div class="errors" id="errors">';
                    echo '<div class="close">';
                        echo '<button type="button" id="close"><i class="fas fa-times"></i></button>';
                    echo '</div>';
                    echo '<div class="err_content">';
                        foreach ($error as $value) {
                            echo "<p>";
                                echo $value;
                            echo "</p>";
                        }
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }

    ?>
<div class="row row-cols-1 row-cols-md-4" id="show">
    <!-- dynamically show -->
</div>



</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">More About the Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>Teacher:-</li>
                    <li>Students Enrolled:-</li>
                    <li>Description:-</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <?php  

            if($last>1){
                echo '<nav aria-label="Page navigation example">';
                    echo '<ul class="pagination">';
                            echo $first;
                        echo '</li>';
                        echo '<li class="page-item">';
                            echo $previous;
                        echo '</li>';
                        echo '<li class="page-item"><a class="page-link"> ' . $page_number ." / ".$last. '</a></li>';
                        echo '<li class="page-item">';
                            echo $next;
                        echo '</li>';
                        echo '<li class="page-item">';
                            echo $last_nu;
                        echo '</li>';
                    echo '</ul>';
                echo '</nav>';

            }

        ?>   
    </div>
    <div class="col-md-4"></div>
    </div>
</div>

<script src="https://kit.fontawesome.com/4f6c585cf2.js" crossorigin="anonymous"></script>

<?php include ('stu_footer.php'); ?>

<script>
    $(document).ready(function(){

        $(window).on('load',function(){

            var student_id = '<?php echo $student_id; ?>';
            var start = <?php echo $start; ?>;
            var grid_per_page = <?php echo $grid_per_page; ?>;
            var page_number = <?php echo $page_number ?>;

            $.post('showallcourse.php',{
                student_id:student_id,
                start:start,
                grid_per_page:grid_per_page,
                page_number:page_number
            },function(data){
                $('#show').html(data);
            });
        });

    });
</script>
<script>
    $(document).ready(function(){

        $('#search_cos').on('keyup',function(){
            var student_id = '<?php echo $student_id; ?>';
            var search = $('#search_cos').val();
            var page_number = <?php echo $page_number ?>;

            $.post('search_course_re.php',{
                student_id:student_id,
                search:search,
                page_number:page_number
            },function(data){
                $('#show').html(data);
            });
        });

    });
</script>
<script>
    let enroll_key = document.querySelector('#enroll_key');

    function checkenroll(event){
        is_enrolled = event.target.parentElement.parentElement.children[1].getAttribute('value');

        if(is_enrolled==1){
            event.target.parentElement.parentElement.children[2].style.opacity = 1;
            let int = event.target.parentElement.parentElement.children[2].value;
            if(int!=""){
                event.target.setAttribute('type','submit');
            }
        }
        else{
            event.target.setAttribute('type','submit');
        }
    }
</script>
<script>
    //errors
    const close = document.querySelector('#close');
    const model= document.querySelector('.err_model');
    const body = document.querySelector('body');
    close.addEventListener('click',function(){
        model.classList.add('erhide');

        model.addEventListener('transitionend',function(){
            model.style.display = "none";
        });
    });
    body.addEventListener('click',function(){
        model.classList.add('erhide');
        model.addEventListener('transitionend',function(){
            model.style.display = "none";
        });
    });
</script>