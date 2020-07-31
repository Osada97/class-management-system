<?php ob_start() ?>
<?php include('../inc/admin_header.php') ?>
<?php require_once ('../inc/connection.php');?>

<?php  
    
    if(!isset($_SESSION['admin_id'])){
        header('Location:../signin.php');
    }

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

/*Modal Styling*/
.modal-body .student_dp{
    width: 100%;
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.modal-body .student_details{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    flex-wrap: wrap;
}
.modal-body .student_details h3{
    font-size: 20px;
    color: red;
}
.modal-body .student_details .cous_det{
    width: 100%;
    display: flex;
    justify-content: space-around;
}
.modal-body .student_details .cous_det .numcosbox{
    flex: 1;
    margin: 0 5px;
    padding: 15px;
    border: 1px solid #eee;
    text-align: center;
    background-color: #fff4f4;
}
.modal-body .student_details .cous_det .numcosbox h4{
    font-size: 15px;
}
.modal-body .student_details .cous_det .numcosbox h6{
    font-size: 35px;
    color: #fb1d1d;
}
.modal-body .student_details .email{
    margin: 12px 0;
    font-size: 18px;
    font-weight: 400;
}
.modal-body .student_details .email i{
    margin-right: 5px;
}
.modal-body .student_details  .number{
    font-size: 17px;
    letter-spacing: 1.3px;
    color: #5002dc;
}
.modal-body .student_details  h5 i{
    margin-right: 8px;
}
.col-md-8{
    width: 100%;
}
.search_row{
    width: 100%;
}
.search_row .form-control{
    width: 50%;
    box-shadow: none;
    transition: 0.6s;
}
.search_row .form-control:focus{
    width: 100%;
}
#tbody h2{
    margin: 25px 0;
    color: #ff710c;
}

</style>

      <div class="container-fluid">
        <h1 class="mt-4">Student Management</h1>
       
      </div>

        <div class="row">
            <div class="container ">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="container search_row mt-4 mb-4">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search Student Name Or Email Or Student Id" aria-label="Search" id="search_student">
                    </div>
                </div>
                <!-- Starting Modal replace id with suitable name and write the button -->

                <div class="modal fade" id="more" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                   <div class="modal-dialog" id="student_more">
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
                                            <h4>Number Of Courses Stuent Enrolled</h4>
                                            <h6>8</h6>
                                        </div>
                                    </div>
                        
                                    <h4>osadamanohara55@gmial.com</h4>
                                </div>
                                <h5>0768597090</h5>
                            </div>
                       </div> -->
                   </div>
                </div>



                <!-- Ending Model -->

    <!--Student Table-->

                <table class="table table-hover mt-4">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col">Options</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    
                        <!-- dynamically add in show_st_table.php using Ajax -->

                    </tbody>
                </table>

                <label for=""></label>

                <!--end Table-->
                <div class="col-md-2"></div>
            </div>
        </div>

        <script src="https://kit.fontawesome.com/4f6c585cf2.js" crossorigin="anonymous"></script><!-- font awsome script -->


  <?php include('../inc/admin_footer.php')?>
        <script>

            //loading table using ajax
            $(document).ready(function(){

                $(window).on('load',function(){
                    $.post('show_st_table.php',{},
                        function(data){
                            $('#tbody').html(data);
                    });
                });

            });

            //ajax remove students
            function rem_stident(st_no){
                var student_no = st_no;

                if(true==confirm("Are You Sure?")){
                    
                    $.post('remove_students.php',{
                        student_no:student_no
                    });
                }
            }

            //ajax freez students
            function frez_student(st_no,event){
                var student_no = st_no;
                var isck = event.target.getAttribute('checked');

                if(isck==null){
                    $.post('student_freez.php',{
                        freez :'false',
                        student_id:student_no
                    },function(data){
                        console.log(data);
                    });
                }
                else{
                    $.post('student_freez.php',{
                        freez :'true',
                        student_id:student_no
                    },function(data){
                        console.log(data);
                    });
                }
            }

            //ajax search student
            $('#search_student').on('keyup',function(){
                var search = $('#search_student').val();

                $.post('admin_search_student.php',{
                    search:search
                },function(data){
                    $('#tbody').html(data);
                });
            });

             //ajax teacher more button
            function student_more(s_id){
                var student_id = s_id;

                $.post('admin_student_more.php',{
                    student_id:student_id
                },function(data){
                    $('#student_more').html(data);
                    console.log(data);
                });
            }

        </script>

