<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/update_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminUpdate($db);

	$sel->comp_code = $_POST['comp_code'];
	$sel->code = $_POST['code'];
	$sel->name = $_POST['name'];

 	$query = $sel->updateCompany();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>