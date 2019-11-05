<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminInsert($db);

	$sel->dept_code = $_POST['code'];
	$sel->dept_name = $_POST['name'];

	$query = $sel->addNewDepartment();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>