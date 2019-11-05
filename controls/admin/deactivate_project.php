<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminUpdate($db);

	$sel->proj_id = $_POST['ids'];

 	$query = $sel->deactivateProject();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>