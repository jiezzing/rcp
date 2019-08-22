<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminUpdate($db);

	$sel->dept_id = $_POST['ids'];

 	$query = $sel->deactivateDepartment();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>