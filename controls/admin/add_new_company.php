<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminInsert($db);

	$sel->comp_code = $_POST['code'];
	$sel->comp_name = $_POST['name'];

	$query = $sel->addNewCompany();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>