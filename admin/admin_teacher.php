<?php ob_start(); ?>
<?php include_once('../inc/admin_header.php') ?>

<?php  
    
    if(!isset($_SESSION['admin_id'])){
        header("Location:../signin.php");
    }

?>

      <div class="container-fluid">
        <h1 class="mt-4">Teacher Management</h1>
        
      </div>


<?php require_once ('../inc/connection.php');

//var_dump($data);

?>

<style>
 
.switch{
    position: relative;
    width: 65px;
    height: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.switch .slider{
    position: absolute;
    width: 100%;
    height: 100%;
    top:0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: #f48fb1;
    border-radius: 35px;
    transition: 0.5s;
    cursor: pointer;
}
.switch .slider:before{
    content: "";
    position: absolute;
    top: 2px;
    bottom: 2px;
    right: 2px;
    left: 2px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background-color: #eee;
    transition: 0.5s;
}
.switch input{
    display: none;
}
.switch input:checked + .slider{
    background-color: #616fc7;
}
.switch input:checked + .slider:before{
    transform: translateX(40px);
}

/*model styling*/
.modal-body .teacher_dp{
    width: 100%;
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
} 
.modal-body .teacher_details{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    flex-wrap: wrap;
}
.modal-body .teacher_details h3{
    font-size: 20px;
    color: red;
}
.modal-body .teacher_details .cous_det{
    width: 100%;
    display: flex;
    justify-content: space-around;
}
.modal-body .teacher_details .cous_det .numcosbox,.numstbox{
    flex: 1;
    margin: 0 5px;
    padding: 15px;
    border: 1px solid #eee;
    text-align: center;
    background-color: #fff4f4;
}
.modal-body .teacher_details .cous_det .numcosbox h4,.numstbox h4{
    font-size: 15px;
}
.modal-body .teacher_details .cous_det .numcosbox h6,.numstbox h6{
    font-size: 35px;
    color: #fb1d1d;
}
.modal-body .teacher_details .email{
    margin: 12px 0;
    font-size: 18px;
    font-weight: 400;
}
.modal-body .teacher_details .email i{
    margin-right: 5px;
}
.modal-body .teacher_details .tc_skills{
    width: 100%;
    margin-top: 12px;
}
.modal-body .teacher_details .tc_skills h5{
    font-size: 16px;
}
.modal-body .teacher_details .tc_skills ul li{
    list-style: none;
    display: inline-block;
    margin-left: 15px;
    color: green;
}
.modal-body .teacher_details .tc_skills ul li i{
    margin-right: 5px;
    color: orange;
}
.modal-body .teacher_details  .number{
    font-size: 17px;
    letter-spacing: 1.3px;
    color: #5002dc;
}
.modal-body .teacher_details  h5 i{
    margin-right: 8px;
}
.container{
    display: flex;
    justify-content: flex-end;
}
.form-control{
    width: 30%;
    transition: 0.6s;
}
.form-control:focus{
    padding: 5px;
    box-shadow: none;
    width: 50%;
}
#tbody h2{
    margin: 25px auto;
    color: #ff710c;
}

</style>

<div class="container mt-4 mb-4">
        <input class="form-control mr-sm-2" type="search" placeholder="Search Teacher Name Or Teacher Email" aria-label="Search" id="search_teacher">
</div>

<!-- Starting Modal replace id with suitable name and write the button -->

<div class="modal fade" id="more" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="teacher_more_model">
        <!-- <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="teacher_dp">
                    <img src='../img/defaultteacher.png' alt='Profile pic' class='rounded-circle' style='width: 150px; height: 150px'>
                </div>
                <div class="teacher_details">
                    <h3>Osada Manohara</h3>
        
                    <div class="cous_det">
                        <div class="numcosbox">
                            <h4>Number Of Course Teacher Provide</h4>
                            <h6>8</h6>
                        </div>
                        <div class="numstbox">
                            <h4>Number Of Students Teacher Have</h4>
                            <h6>8</h6>
                        </div>
                    </div>
        
                    <h4>osadamanohara55@gmial.com</h4>
                    <div class="tc_skills">
                        <ul>
                            <li>php</li>
                            <li>css</li>
                            <li>html</li>
                        </ul>
                    </div>
                </div>
                <h5>0768597090</h5>
            </div>
        </div> -->
    </div>
</div>



<!-- Ending Model -->

<!-- start Table -->
<table class="table table-hover mt-4">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Skills</th>
        <th scope="col">Email</th>
        <th scope="col"></th>
        <th scope="col">Options</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody id="tbody">
        <!-- display in ajax -->
    </tbody>
</table>


<!--end Table-->
      
<?php include_once('../inc/admin_footer.php')?>
<script src="https://kit.fontawesome.com/4f6c585cf2.js" crossorigin="anonymous"></script><!-- font awsome script -->

<script>
    $(document).ready(function(){

        $(window).on('load',function(){
            $.post('show_tc_table.php',{},function(data){
                $('#tbody').html(data);
            });
        });

    });

    function rem_teacher(teacher_id){
        var teacher_id = teacher_id;

        if(true==confirm("Are You Sure?")){

            $.post('remove_teacher.php',{
                teacher_id:teacher_id
            });
        }

    }

    function frez_teacher(teacher_id){
        var teacher_id = teacher_id;
        var isck = event.target.getAttribute('checked');

        if(isck==null){

            $.post('teacher_freez.php',{
                teacher_id:teacher_id,
                freez:'false'
            },function(data){
                console.log(data);
            });
        }
        else{
            $.post('teacher_freez.php',{
                teacher_id:teacher_id,
                freez:'true'
            },function(data){
                console.log(data);
            });
        }

    }

    //ajax search
    $('#search_teacher').on('keyup',function(){

        var search = $('#search_teacher').val();
        $.post('admin_search_teacher.php',{
            search:search
        },function(data){
            $('#tbody').html(data);
        });
    });

    //ajax teacher more button
    function teacher_more(t_id){
        var teacher_id = t_id;

        $.post('admin_teacher_more.php',{
            teacher_id:teacher_id
        },function(data){
            $('#teacher_more_model').html(data);
        });
    }
</script>



