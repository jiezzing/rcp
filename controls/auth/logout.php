<?php 
	session_start(); 
	include '../../config/connection.php';
	include '../../objects/requestor/select_queries.php';

	$con = new connection();
	$db = $con->connect();

	$sel = new Select($db);
	$logout = $sel->logout();
	if($logout){
		header("Location: ../../index.php");
		session_destroy();
		exit();
	}
?>