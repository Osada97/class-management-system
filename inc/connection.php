<?php  

	/*prepare connection*/

	$connection = mysqli_connect('localhost','root','','elearn');

	if(mysqli_connect_error()){
		die('Database Connection Failed ' . mysqli_connect_error());
	}

?>