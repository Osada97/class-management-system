<?php ob_start(); ?>
<?php session_start() ?>
<?php include_once("../inc/header.php"); ?>
<?php require_once("../inc/connection.php"); ?>

<?php  
    
    if(!isset($_SESSION['teacher_id'])){
        header("Location:../signin.php");
    }
    else{
        $teacher_id = $_SESSION['teacher_id'];
    }
    if(!isset($_GET['course_id'])){
        header("Location:teacher_dashboard.php");
    }
    else{
        $course_id = $_GET['course_id'];
    }
    //add media
    $error = array();

    if(isset($_POST['submit'])){

        $text = mysqli_real_escape_string($connection,$_POST['msg']);


        //getting chapter id 
        $query = "SELECT chapter FROM media WHERE teacher_id = {$teacher_id} AND course_id = {$course_id} ORDER BY chapter DESC";
        $result_set = mysqli_query($connection,$query);

            if($result_set){
                if(mysqli_num_rows($result_set) != 0){
                    $final_chapter = mysqli_fetch_assoc($result_set);
                    $chapter_id = $final_chapter['chapter'] +1;
                }
                else{
                    $chapter_id = 1;
                }
            }


         //validation files
        if($_FILES['add_media']['name'][0] !=null){
            
            if(isset($_FILES['add_media']['name'][0])){

                $total_file = count($_FILES['add_media']['name']);

                for ($i=0; $i <$total_file ; $i++) { 
                    $file_name = $_FILES['add_media']['name'][$i];
                    $temp_file = $_FILES['add_media']['tmp_name'][$i];
                    $file_size = $_FILES['add_media']['size'][$i];
                    $file_type = $_FILES['add_media']['type'][$i];

                    //checking file max size
                    if($file_type == "video/mp4"){
                        if($file_size >= 1000000000){
                            $error[] = $file_name . " Must Be Less Than 1GB";
                        }
                    }
                    if($file_type == "video/mp4" || $file_type == "image/png" || $file_type == "image/gif"){
                        if($file_size >= 512000){
                            $error[] = $file_name . " Must Be Less Than 500KB";
                        }
                    }
                     if($file_type == "audio/mpeg"){
                        if($file_size >= 512000){
                            $error[] = $file_name . " Must Be Less Than 500KB";
                        }
                    }

                    //checking file types
                    $file_types = array("mp4","xls","png","gif","mpeg","jpg","jepg","mp3","pdf","docx","txt","html","js","css","pptx","ppt");

                    $upload_file_type = explode(".",$file_name);
                    $file_type = array_pop($upload_file_type);
                    
                    if(in_array($file_type, $file_types)){
                        //upload file goes in here
                        $upload_to = "../course_media/";
       
                        echo $chapter_id;

                        $new_file_name = $course_id."-".$chapter_id."-".$file_name;
                        
                        if(move_uploaded_file($temp_file, $upload_to.$new_file_name)){

                            $insert_query = "INSERT INTO media(teacher_id,course_id,chapter,is_media,media,text,date) VALUES({$teacher_id},{$course_id},{$chapter_id},1,'{$new_file_name}','{$text}',NOW()) ";
                            $result_inser = mysqli_query($connection,$insert_query);

                            if($result_inser){

                            }
                            else{
                                $error[] = "Something Wrong Please Try Again";
                            }
                        }
                        else{
                            $error[]= $file_name . "Can Not Upload";
                        }

                    }
                    else{
                        $error[] = $file_name . " File Type Is Invalid";
                    }
                }
            }
        }
        else{
            if(!empty($text)){

                $insert_query = "INSERT INTO media(teacher_id,course_id,chapter,is_media,text,date) VALUES({$teacher_id},{$course_id},{$chapter_id},0,'{$text}',NOW()) ";
                 $result_inser = mysqli_query($connection,$insert_query);

                 if($result_inser){

                 }
                 else{
                    print_r(mysqli_error($connection));
                 }

            }
            else{
                $error[] = "Please Select File";
            }
        }


    }
?>

<?php  
    
    //time ago function
    require_once('../inc/coursetimeago.php');

    $display="";//for css purpose
    $card ="";
    $me="";

    //retrieve courses
    //getting from chapter 

    $query_chp = "SELECT DISTINCT(chapter)  FROM media WHERE course_id = {$course_id}";
    $result_ret = mysqli_query($connection,$query_chp);

    if($result_ret){
        while ($chap = mysqli_fetch_assoc($result_ret)){
            $chapter = $chap['chapter'];

            $card .= '<div class="card">';
            $card .= '<div class="card-header">';
            $card .= 'Chapter 0'.$chapter;
            $card .= '</div>';
            $card .= '<div class="card-body">';

        $query = "SELECT * FROM media WHERE teacher_id = {$teacher_id} AND course_id = {$course_id} AND chapter = {$chapter}";
        $result = mysqli_query($connection,$query);

            if($result){
                if(mysqli_num_rows($result) > 0){
                    $me = "";
                    while ($met = mysqli_fetch_assoc($result)) {

                            $met_all_media = array($chapter => array('is_media'=>$met['is_media'],'media'=>$met['media'],'text'=>$met['text'],'date'=>$met['date']));
                           // $met_all_media = array($chapter => $met['media'] ,$met['text']);

                        //checking file type
                        if($met_all_media[$chapter]['is_media'] == 1){
                            foreach ($met_all_media[$chapter] as $media => $value) {
                                if($media=="media"){

                                    $me .= "<div class=meRow>";

                                    //getting file type and set image
                                    $ecimage = explode(".", $value);
                                    $up_file_ty = array_pop($ecimage);
                                    
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

                                    //remove course_id and chapter in a tag
                                    $val =explode('-', $value);//convert array
                                    unset($val[0]);//remove first and second indexes
                                    unset($val[1]);
                                    $val = implode("-", $val);//and again put it into string
                                    $me .= '<a href="../course_media/'.$value.'" target="_blank">' . $val . '</a><br>';

                                    $me .= "</div>";

                                }
                            }
                        }

                    }

                        $card .= '<blockquote class="blockquote mb-0">';

                        if($met_all_media[$chapter]['text'] != null){
                            $card .= '<p>' . $met_all_media[$chapter]['text'] .'</p>';
                        }
                         //display medias in a tag
                        $card .= "<div class='medmed'>";
                        $card .= $me;
                        $card .= "</div>";

                        $card .= '<footer class="blockquote-footer">' . course_time_ago($met_all_media[$chapter]['date'] ) .'</footer>';
                        $card .= '</blockquote>';
                }
            }
            else{
                print_r(mysqli_error($connection));
            }

            $card .= '</div>';
            $card .= '</div>';
        }

    }


?>
<!-- styles -->
<style>
    .card{
        margin-bottom: 15px;
    }
    .blockquote footer{ 
        text-align: right;
    }
    .medmed{
        width: 100%;
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
        flex-direction: column;
    }
    .meRow{
        margin-bottom: 10px;
        width: 100%;
        padding: 5px 8px;
        border-bottom: 1px solid #eeeeee87;
        transition: 0.3s;
    }
    .meRow a{
        color: #000;
        font-size: 15px;
        margin-left: 10px;
        text-decoration: none;
        transition: 0.3s;
    }
    .meRow:hover{
        transform: translateX(3px);
    }
    .meRow img{
        width: 28px;
    }
    .meRow a:hover{
        color: #6b0eff; 
    }
    .meRow a:active{
        color: red; 
    }
    .meRow:visited{
        background-color: #eee; 
    }
    .blockquote p{
        font-size: 17px;
    }
</style>

<div class="container-fluid mt-4">
    <div class="col-md-2"></div>
    <div class="row justify-content-center">
    <div class="col-md-8">
            <div class="jumbotron">
                <h1 class="display-4">Welcome to Upload Center!</h1>
                <p class="lead">Upload your Course Material in here</p>
                <hr class="my-4">
                <p>Compatible with PDF and other Video formats</p>
                <a href="teacher_dashboard.php"><button class="btn btn-info">Return to Dashboard</button></a>
                
            </div>
        <div class="row">
        <div class="col-md-3">
            <div class="card bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Students
                  <button class="btn" style="margin-left: 2.9rem;" data-toggle="modal" data-target="#add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
                <div class="card-body">
                    <div class="scroll">
                        sfkcjgasbukcjbvaskuvjboikvjbsdkvjbsilvkjbwsdkjbvkj
                    </div>

                </div>
            </div>

        </div>
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Search for Students</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form class=" my-2 my-lg-0">
                                <div class="form-inline">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class=" btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select From the List</label>

                                    <ul class="list-group">
                                        <div class="overflow-auto">
                                        <li class="list-group-item">Cras justo odio <i class="fa fa-plus" aria-hidden="true"></i>
                                        </li>
                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                        <li class="list-group-item">Morbi leo risus</li>
                                        <li class="list-group-item">Porta ac consectetur ac</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                        </div>
                                    </ul>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <!-- <div class="card" style="display: <?php if($display==true){echo "block";}else{echo "none";} ?>;">
                    <div class="card-header">
                        Quote
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>
                    </div>
                </div> -->
                <?php echo $card; ?>
                <form action="addmedia.php?course_id=<?php echo $course_id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="main_media_container">
                        <?php  
                            if (!empty($error)) {
                                echo "<div class = 'error'>";
                                    foreach ($error as  $value) {
                                        echo "<p>";
                                            echo $value;
                                        echo "</p>";
                                    }
                                echo "</div>";
                            }
                        ?>
                        <button type="button" id="add" class="btn btn-success mb-4">Add Media <small> (Scroll Down) </small></button>
                        <div class="form-group hide" id="mainme" style="display: none;">
                            <textarea name="msg" id="msg" cols="30" rows="10" class="form-control mb-4"></textarea>
                            <div class="media"></div>
                            <div class="row">
                            <div class="col-md-6">
                           <label class="btn btn-outline-danger form-control-file">Add Content
                               <input  type="file" name="add_media[]" multiple="" hidden></label>
                            </div>
                            <div class="col-md-6">
                           <label class="btn  btn-outline-secondary form-control-file" >
                                Upload Document
                            <input type="submit" value="Upload Documents" name="submit" hidden>
                           </label>
                            </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>


    </div>
    </div>
    <div class="col-md-2">

    </div>

</div>

<!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#add').click(function(){
        $('#mainme').slideToggle(600);
    });
</script>

<?php include_once ("teacher_footer.php"); ?>
