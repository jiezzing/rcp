<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/admin/insert_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new AdminInsert($db);

	$sel->proj_code = $_POST['code'];
	$sel->proj_name = $_POST['name'];

	$query = $sel->addNewProject();
	if($query){
		echo 'Success';
	}
	else{
		echo 'Error';
	}
?>