<?php  

	require_once('../inc/connection.php');


	$query = 'select * from teacher';
	$result = mysqli_query($connection,$query);
	$data = mysqli_fetch_all($result,MYSQLI_ASSOC);

	foreach ($data as $details):
        if($details['freez']==1) {
            echo '<tr style="background-color:#deedfd47">';
        }
        else{
            echo '<tr style="background-color:#fff">';
        }
        	echo '<td scope="row">'.$details["teacher_id"].'</td>';
        	echo '<td>'.$details["first_name"].'</td>';
        	echo '<td>'.$details["last_name"].'</td>';
        	echo '<td>'.$details["skills"].'</td>';
        	echo '<td>'.$details["email"].'</td>';
        	echo '<td><button class="btn btn-danger" onclick="rem_teacher(\''.$details["teacher_id"].'\')"><i class="far fa-trash-alt"></i></button></td>';

        	if($details['freez']==0){
            	echo '<td><div class="switch"><label class="sw"><input type="checkbox" id="tg" onclick="frez_teacher(\''.$details["teacher_id"].'\',event)"><span class="slider"></span></label></div></td>';
            }
            else{
            	echo '<td><div class="switch"><label class="sw"><input type="checkbox" id="tg" checked="checked" onclick="frez_teacher(\''.$details["teacher_id"].'\',event)"><span class="slider"></span></label></div></td>';
            }

        	echo '<td><button class="btn btn-info" data-toggle="modal" data-target="#more" onclick="teacher_more('.$details["teacher_id"].')"><i class="far fa-eye"></i></button></td>';
        echo '</tr>';

     endforeach;

?>