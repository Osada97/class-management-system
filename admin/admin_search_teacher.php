<?php  
	require_once('../inc/connection.php');
	
	$search = $_POST['search'];

	$query_se_tc ="SELECT * FROM teacher WHERE  CONCAT(first_name,' ',last_name) LIKE '{$search}%' OR email LIKE '%{$search}%'";
	$result_se_tc = mysqli_query($connection,$query_se_tc);

	if($result_se_tc){
		if(mysqli_num_rows($result_se_tc)>0){
			$data = mysqli_fetch_all($result_se_tc,MYSQLI_ASSOC);

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

		        	echo '<td><button class="btn btn-info" data-toggle="modal" data-target="#more ">More</button></td>';
		        echo '</tr>';

		     endforeach;

		}
		else{
			echo "<h2>No Result Found</h2>";
		}
	}
	else{
		print_r(mysqli_error($connection));
	}

?>