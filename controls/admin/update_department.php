<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminUpdate($db);

	$sel->dept_code = $_POST['dept_code'];
	$sel->code = $_POST['code'];
	$sel->name = $_POST['dept_name'];

 	$query = $sel->updateDepartment();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>