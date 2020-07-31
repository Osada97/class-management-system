<?php 
	require_once('../inc/connection.php');

	$search = $_POST['search'];

	$query_search = "SELECT * FROM student WHERE st_id LIKE '%{$search}$' OR CONCAT(first_name,' ',last_name) LIKE '{$search}%' OR email LIKE '%{$search}$'";
	$result_search = mysqli_query($connection,$query_search);

	if($result_search){
		if(mysqli_num_rows($result_search)>0){

			$data = mysqli_fetch_all($result_search,MYSQLI_ASSOC);

			foreach ($data as $details):
				if($details['freez']==0){
					echo '<tr style="background-color:#fff">';
				}
				else{
					echo '<tr style="background-color:#deedfd47">';
				}
		            echo '<td scope="row">'.$details["st_id"].'</td>';
		            echo '<td>'.$details["first_name"].'</td>';
		            echo '<td>'.$details["last_name"].'</td>';
		            echo '<td>'.$details["user_name"].'</td>';
		            echo '<td>'.$details["email"].'</td>';
		            echo '<td><button class="btn btn-danger" onclick="rem_stident(\''.$details["st_id"].'\')"><i class="far fa-trash-alt"></i></button></td>';
		            if($details['freez']==0){
		            	echo '<td><div class="switch"><label class="sw"><input type="checkbox" id="tg" onclick="frez_student(\''.$details["st_id"].'\',event)"><span class="slider"></span></label></div></td>';
		            }
		            else{
		            	echo '<td><div class="switch"><label class="sw"><input type="checkbox" id="tg" checked="checked" onclick="frez_student(\''.$details["st_id"].'\',event)"><span class="slider"></span></label></div></td>';
		            }
		            echo '<td><button class="btn btn-info" data-toggle="modal" data-target="#more">More</button></td>';
		        echo '</tr>';
		                            
		    endforeach;

		}
		else{
			echo "<h2>No Result Foumd</h2>";
		}
	}

?>