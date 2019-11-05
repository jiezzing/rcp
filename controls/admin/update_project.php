<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminUpdate($db);

	$sel->proj_code = $_POST['proj_code'];
	$sel->code = $_POST['code'];
	$sel->name = $_POST['name'];

 	$query = $sel->updateProject();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>